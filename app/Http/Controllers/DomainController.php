<?php

namespace App\Http\Controllers;

use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use DiDom\Document;

class DomainController extends Controller
{
    private $client;

    public function __construct(\GuzzleHttp\ClientInterface $client)
    {
        $this->client = $client;
    }

    public function index(Request $request)
    {
        $domains = \DB::table('domains')->paginate(2);
        return view('domain.index', ['domains' => $domains]);
    }

    public function store(Request $request)
    {
        try {
            $this->validate($request, [
                'name' => 'required'
            ]);
            $response = $this->client->request('GET', $request->name);
            $statusCode = $response->getStatusCode();
            $headers = $response->getHeaders();
            $contentLength = array_key_exists('Content-Length', $headers) ? $headers['Content-Length'][0] : null;
            $body = $response->getBody()->getContents();
            $utf8Body = iconv(mb_detect_encoding($body), "UTF-8//TRANSLIT", $body);
            $document = new Document($utf8Body);
            if ($document->has('meta[name="keywords"]')) {
                $keywords = $document->find('meta[name="keywords"]')[0]->attr('content');
            }
            if ($document->has('meta[name="description"]')) {
                $description = $document->find('meta[name="description"]')[0]->attr('content');
            }
            if ($document->has('h1')) {
                $heading = $document->find('h1')[0]->text();
            }
        } catch (\Exception $e) {
            return view('page.main', ['domain' => $request->name, 'error' => $e->getMessage()]);
        }

        if (\DB::table('domains')->where('name', $request->name)->doesntExist()) {
            \DB::table('domains')->insert([
                'name' => $request->name,
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
                'status_code' => $statusCode,
                'content_length' => $contentLength,
                'body' => $utf8Body,
                'keywords' => $keywords ?? null,
                'description' => $description ?? null,
                'heading' => $heading ?? null
                ]);
        } else {
            \DB::table('domains')
              ->where('name', $request->name)
              ->update([
                'updated_at' => date("Y-m-d H:i:s"),
                'status_code' => $statusCode,
                'content_length' => $contentLength,
                'body' => $utf8Body,
                'keywords' => $keywords ?? null,
                'description' => $description ?? null,
                'heading' => $heading ?? null
              ]);
        };

        $domain = \DB::table('domains')->where('name', $request->name)->first();
        return redirect()
            ->route('domains.show', ['id' => $domain->id]);
    }

    public function show(Request $request, $id)
    {
        $domain = \DB::table('domains')->find($id);
        return view('domain.show', ['domain' => $domain]);
    }
}
