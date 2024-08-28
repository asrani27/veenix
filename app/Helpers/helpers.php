<?php

use App\Models\Post;
use App\Models\Year;
use App\Models\Genre;
use DOMXPath as Xpath;
use App\Models\Country;
use App\Models\Setting;
use DOMDocument as DOM;
use voku\helper\HtmlDomParser;
use Illuminate\Support\Facades\Http;
use Eelcol\LaravelHtmlDom\Facades\SuperDom;

function deadLinkVideo()
{
    return Post::where('dead_link_video', 1)->count();
}
function noLinkDownload()
{
    return Post::where('link_download', null)->count();
}
function totalMoview()
{
    return Post::count();
}
function histats()
{
    return Setting::first() == null ? null : Setting::first()->histats;
}
function logo()
{
    return Setting::first() == null ? null : Setting::first()->logo;
}
function genre()
{
    return Genre::where('is_active', 'Y')->get();
}
function year()
{
    return Year::orderBy('id', 'desc')->get();
}
function country()
{
    return Country::get();
}
function checkGenapGanjil($semester, $matakuliah)
{
    if ($semester % 2 == 0) {
        $hasil = 'GENAP';
    } else {
        $hasil = 'GANJIL';
    }

    if ($hasil == $matakuliah) {
        $result = true;
    } else {
        $result = false;
    }
    return $result;
}

function topMovies()
{
    $data = Post::orderBy('views', 'desc')->take(8)->get();
    return $data;
}

function latestMovies()
{
    $data = Post::orderBy('id', 'desc')->take(16)->get();
    return $data;
}

function latestSeries()
{
    $data = Post::orderBy('id', 'desc')->take(16)->get();
    return $data;
}
function fixAmps(&$html, $offset)
{
    $positionAmp = strpos($html, '&', $offset);
    $positionSemiColumn = strpos($html, ';', $positionAmp + 1);

    $string = substr($html, $positionAmp, $positionSemiColumn - $positionAmp + 1);

    if ($positionAmp !== false) { // If an '&' can be found.
        if ($positionSemiColumn === false) { // If no ';' can be found.
            $html = substr_replace($html, '&amp;', $positionAmp, 1); // Replace straight away.
        } else if (preg_match('/&(#[0-9]+|[A-Z|a-z|0-9]+);/', $string) === 0) { // If a standard escape cannot be found.
            $html = substr_replace($html, '&amp;', $positionAmp, 1); // This mean we need to escape the '&' sign.
            fixAmps($html, $positionAmp + 5); // Recursive call from the new position.
        } else {
            fixAmps($html, $positionAmp + 1); // Recursive call from the new position.
        }
    }
}


function sf21($uri)
{
    $html = file_get_contents($uri);
    $html = preg_replace('/\s+/', ' ', trim($html));
    fixAmps($html, 0);
    $dom = new DOM();
    @$dom->loadHTML($html);
    $xpath = new Xpath($dom);

    $data['title'] = $xpath->query('//h1[@class="entry-title"]')->item(0)->nodeValue;
    $data['slug'] = Str::of($data['title'])->slug('-')->value();
    $data['description'] = $xpath->query('//div[@class="entry-content entry-content-single"]//p')->item(0)->nodeValue;
    $data['link_video'] = null;
    $link_download = array();

    $count_download = $xpath->query('//ul[@class="list-inline gmr-download-list clearfix"]//li//a/@href')->length;
    if ($count_download == 0) {
        $data['link_download'] = null;
    } else {
        for ($x = 0; $x < $count_download; $x++) {
            $link_download[] = $xpath->query('//ul[@class="list-inline gmr-download-list clearfix"]//li//a/@href')->item($x)->nodeValue;
        }
        $data['link_download'] = json_encode($link_download);
    }
    // $data['link_download'] = $xpath->query('//ul[@class="list-inline gmr-download-list clearfix"]//li//a/@href')->item(0) == null ? null : trim($xpath->query('//ul[@class="list-inline gmr-download-list clearfix"]//li//a/@href')->item(0)->nodeValue);

    //dd($dom, $data);
    if ($xpath->query('//figure[@class="pull-left"]//img/@src')->length == 1) {
        $data['image'] = $xpath->query('//figure[@class="pull-left"]//img/@src')->item(0)->nodeValue;
    } else {
        $data['image'] = $xpath->query('//figure[@class="pull-left"]//img/@src')->item(1)->nodeValue;
    }
    $detail = $xpath->query('//div[@class="gmr-moviedata"]');

    foreach ($detail as $key => $d) {
        //get Genres
        if (strpos($d->nodeValue, 'Genre') !== false) {
            $genres = explode(',', str_replace("Genre: ", "", $d->nodeValue));
            $genre = array();
            foreach ($genres as $item) {
                $genre[] = trim($item);
            }
            $genre = json_encode($genre);
        }

        // Get Quality
        if (strpos($d->nodeValue, 'Kualitas') !== false) {
            $quality = str_replace("Kualitas: ", "", $d->nodeValue);
        }

        // Get Country
        if (strpos($d->nodeValue, 'Negara') !== false) {

            $countrys = explode(',', str_replace("Negara:", "", $d->nodeValue));
            $country = array();
            foreach ($countrys as $item) {
                $country[] = trim($item);
            }
            $country = json_encode($country);
        }
        // Get Actor
        if (strpos($d->nodeValue, 'Pemain') !== false) {

            $actors = explode(',', str_replace("Pemain:", "", $d->nodeValue));
            $actor = array();
            foreach ($actors as $item) {
                $actor[] = trim($item);
            }
            $actor = json_encode($actor);
        }
        // Get Year
        if (strpos($d->nodeValue, 'Tahun') !== false) {
            $year = str_replace("Tahun: ", "", $d->nodeValue);
        }
        // Get duration
        if (strpos($d->nodeValue, 'Durasi') !== false) {
            $duration = str_replace("Durasi: ", "", $d->nodeValue);
        }
        // Get Release
        if (strpos($d->nodeValue, 'Rilis') !== false) {
            $release = str_replace("Rilis:", "", $d->nodeValue);
        }
        // Get Director
        if (strpos($d->nodeValue, 'Direksi') !== false) {
            $director = str_replace("Direksi:", "", $d->nodeValue);
        }
    }
    $data['genre'] = $genre;
    $data['quality'] = $quality;
    $data['country'] = $country;
    $data['year'] = $year;
    $data['duration'] = $duration;
    $data['release'] = $release;
    $data['actor'] = $actor;
    $data['director'] = $director;
    $data['username'] = Auth::user()->username;

    return $data;
}


function senatorPeters($uri)
{
    $html = file_get_contents($uri);
    $html = preg_replace('/\s+/', ' ', trim($html));
    fixAmps($html, 0);
    $dom = new DOM();
    @$dom->loadHTML($html);
    $xpath = new Xpath($dom);

    $data['title'] = $xpath->query('//h1[@class="entry-title"]')->item(0)->nodeValue;
    $data['slug'] = Str::of($data['title'])->slug('-')->value();
    $data['description'] = $xpath->query('//div[@class="entry-content entry-content-single"]//p')->item(0)->nodeValue;
    $data['link_video'] = trim($xpath->query('//div[@class="iframe-container"]//iframe/@src')->item(0)->nodeValue);
    $data['link_download'] = $xpath->query('//ul[@class="list-inline gmr-download-list clearfix"]//li//a/@href')->item(0) == null ? null : trim($xpath->query('//ul[@class="list-inline gmr-download-list clearfix"]//li//a/@href')->item(0)->nodeValue);
    if ($xpath->query('//figure[@class="pull-left"]//img/@src')->length == 1) {
        $data['image'] = $xpath->query('//figure[@class="pull-left"]//img/@src')->item(0)->nodeValue;
    } else {
        $data['image'] = $xpath->query('//figure[@class="pull-left"]//img/@src')->item(1)->nodeValue;
    }
    $detail = $xpath->query('//div[@class="gmr-moviedata"]');

    foreach ($detail as $key => $d) {
        //get Genres
        if (strpos($d->nodeValue, 'Genre') !== false) {
            $genres = explode(',', str_replace("Genre: ", "", $d->nodeValue));
            $genre = array();
            foreach ($genres as $item) {
                $genre[] = trim($item);
            }
            $genre = json_encode($genre);
        }

        // Get Quality
        if (strpos($d->nodeValue, 'Kualitas') !== false) {
            $quality = str_replace("Kualitas: ", "", $d->nodeValue);
        }

        // Get Country
        if (strpos($d->nodeValue, 'Negara') !== false) {

            $countrys = explode(',', str_replace("Negara:", "", $d->nodeValue));
            $country = array();
            foreach ($countrys as $item) {
                $country[] = trim($item);
            }
            $country = json_encode($country);
        }
        // Get Actor
        if (strpos($d->nodeValue, 'Pemain') !== false) {

            $actors = explode(',', str_replace("Pemain:", "", $d->nodeValue));
            $actor = array();
            foreach ($actors as $item) {
                $actor[] = trim($item);
            }
            $actor = json_encode($actor);
        }
        // Get Year
        if (strpos($d->nodeValue, 'Tahun') !== false) {
            $year = str_replace("Tahun: ", "", $d->nodeValue);
        }
        // Get duration
        if (strpos($d->nodeValue, 'Durasi') !== false) {
            $duration = str_replace("Durasi: ", "", $d->nodeValue);
        }
        // Get Release
        if (strpos($d->nodeValue, 'Rilis') !== false) {
            $release = str_replace("Rilis:", "", $d->nodeValue);
        }
        // Get Director
        if (strpos($d->nodeValue, 'Direksi') !== false) {
            $director = str_replace("Direksi:", "", $d->nodeValue);
        }
    }
    $data['genre'] = $genre;
    $data['quality'] = $quality;
    $data['country'] = $country;
    $data['year'] = $year;
    $data['duration'] = $duration;
    $data['release'] = $release;
    $data['actor'] = $actor;
    $data['director'] = $director;
    $data['username'] = Auth::user()->username;

    return $data;
}

function thetender($uri)
{
    $html = file_get_contents($uri);
    $html = preg_replace('/\s+/', ' ', trim($html));
    fixAmps($html, 0);
    $dom = new DOM();
    @$dom->loadHTML($html);
    $xpath = new Xpath($dom);


    $data['title'] = $xpath->query('//h1[@class="entry-title"]')->item(0)->nodeValue;
    $data['slug'] = Str::of($data['title'])->slug('-')->value();
    $data['description'] = $xpath->query('//div[@class="entry-content entry-content-single"]//p')->item(0)->nodeValue;
    $data['link_video'] = trim($xpath->query('//div[@class="gmr-embed-responsive"]//iframe/@data-litespeed-src')->item(0)->nodeValue);
    $data['link_download'] = $xpath->query('//ul[@class="list-inline gmr-download-list clearfix"]//li//a/@href')->item(0) == null ? null : trim($xpath->query('//ul[@class="list-inline gmr-download-list clearfix"]//li//a/@href')->item(0)->nodeValue);
    //dd($xpath->query('//figure[@class="pull-left"]//img/@src')->item(0)->nodeValue, $dom);
    if ($xpath->query('//figure[@class="pull-left"]//img/@src')->length == 1) {
        $data['image'] = $xpath->query('//figure[@class="pull-left"]//img/@data-src')->item(0)->nodeValue;
    } else {
        $data['image'] = $xpath->query('//figure[@class="pull-left"]//img/@data-src')->item(1)->nodeValue;
    }
    $detail = $xpath->query('//div[@class="gmr-moviedata"]');

    foreach ($detail as $key => $d) {
        //get Genres
        if (strpos($d->nodeValue, 'Genre') !== false) {
            $genres = explode(',', str_replace("Genre: ", "", $d->nodeValue));
            $genre = array();
            foreach ($genres as $item) {
                $genre[] = trim($item);
            }
            $genre = json_encode($genre);
        }

        // Get Quality
        if (strpos($d->nodeValue, 'Quality') !== false) {
            $quality = str_replace("Quality: ", "", $d->nodeValue);
        }

        // Get Country
        if (strpos($d->nodeValue, 'Country') !== false) {

            $countrys = explode(',', str_replace("Country:", "", $d->nodeValue));
            $country = array();
            foreach ($countrys as $item) {
                $country[] = trim($item);
            }
            $country = json_encode($country);
        }
        // Get Actor
        if (strpos($d->nodeValue, 'Cast') !== false) {

            $actors = explode(',', str_replace("Cast:", "", $d->nodeValue));
            $actor = array();
            foreach ($actors as $item) {
                $actor[] = trim($item);
            }
            $actor = json_encode($actor);
        }
        // Get Year
        if (strpos($d->nodeValue, 'Year') !== false) {
            $year = str_replace("Year: ", "", $d->nodeValue);
        }
        // Get duration
        if (strpos($d->nodeValue, 'Duration') !== false) {
            $duration = str_replace("Duration: ", "", $d->nodeValue);
        }
        // Get Release
        if (strpos($d->nodeValue, 'Release') !== false) {
            $release = str_replace("Release:", "", $d->nodeValue);
        }
        // Get Director
        if (strpos($d->nodeValue, 'Director') !== false) {
            $director = str_replace("Director:", "", $d->nodeValue);
        }
    }
    $data['genre'] = $genre;
    $data['quality'] = $quality;
    $data['country'] = $country;
    $data['year'] = $year;
    $data['duration'] = $duration;
    $data['release'] = $release;
    $data['actor'] = $actor;
    $data['director'] = $director;
    $data['username'] = Auth::user()->username;

    return $data;
}
