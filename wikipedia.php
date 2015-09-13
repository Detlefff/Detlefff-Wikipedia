<?php
class wikipedia extends Script
{
    protected $helpMessage = "def THING\ndefine THING\ndefiniere THING";
	protected $description = 'Returns the definition of the given string from Wikipedia';

    public function run()
    {
		//Build the URL
		$url = 'https://de.wikipedia.org/w/api.php?format=json&action=query&prop=extracts&exintro=&explaintext=&titles=' . urlencode($this->matches[1]);

		$response = json_decode(file_get_contents($url));

		//Wikipedias API returns an Object named after the Article-ID
		$summary = current((Array)$response->query->pages)->extract;

		$this->send($summary);
    }
}
