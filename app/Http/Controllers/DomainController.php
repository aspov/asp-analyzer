<?php

namespace App\Http\Controllers;

use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use GuzzleHttp\Client;

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
            $contentLength = array_key_exists('content-length', $headers) ? $headers['content-length'] : null;
            $body = $response->getBody()->getContents();
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
                'body' => $body
                ]);
        } else {
            \DB::table('domains')
              ->where('name', $request->name)
              ->update([
                'updated_at' => date("Y-m-d H:i:s"),
                'status_code' => $statusCode,
                'content_length' => $contentLength,
                'body' => $body
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
