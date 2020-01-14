<?php

namespace App\Http\Controllers;

use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use DiDom\Document;
use App\Domain;

class DomainController extends Controller
{
    private $client;

    public function __construct(\GuzzleHttp\ClientInterface $client)
    {
        $this->client = $client;
    }

    public function index(Request $request)
    {
        $domains = Domain::paginate(2);
        return view('domain.index', compact('domains'));
    }

    public function store(Request $request)
    {
        try {
            $this->validate($request, ['name' => 'required']);
            $response = $this->client->request('GET', $request->name);
            $statusCode = $response->getStatusCode();
            $headers = $response->getHeaders();
            $contentLength = array_key_exists('Content-Length', $headers) ? $headers['Content-Length'][0] : null;
            $body = $response->getBody()->getContents();
            $utf8Body = iconv(mb_detect_encoding($body), "UTF-8//TRANSLIT", $body);
            $document = new Document($utf8Body);
            $keywords = $document->find('meta[name="keywords"]');
            $description = $document->find('meta[name="description"]');
            $heading = $document->find('h1');
        } catch (\Exception $e) {
            return view('page.main', ['domain' => $request->name, 'error' => $e->getMessage()]);
        }
        $domain = Domain::firstOrNew(['name' => $request->name]);
        $domain->name = $request->name;
        $domain->status_code = $statusCode;
        $domain->content_length = $contentLength;
        $domain->body = $utf8Body;
        $domain->keywords = $keywords ? $keywords[0]->attr('content') : null;
        $domain->description = $description ? $description[0]->attr('content') : null;
        $domain->heading = $heading ? $heading[0]->text() : null;
        $domain->save();
        return redirect()->route('domains.show', ['id' => $domain]);
        //return redirect()->route('domains.show', [$domain]);
        //return redirect()->route('domains.show', compact('domain'));
        //return redirect()->route('domains.show', $domain);
        //не работают, не хочет связывать id модели с id в route
        //в терминале ошибка #127.0.0.1:43062 [404]: /domains/%7Bid%7D?0=1
        //в логах
        //(2/2) NotFoundHttpException
        //No query results for model [App\Domain] %7Bid%7D
    }

    public function show($id)
    {
        $domain = Domain::findOrFail($id);
        return view('domain.show', compact('domain'));
    }
}
