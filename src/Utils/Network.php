<?php
namespace App\Utils;

/**
 *
 * @author Stefano Pallozzi
 *        
 */
class Network
{

    /**
     *
     * @var string
     */
    const CRLF = "\r\n";

    /**
     *
     * @see https://gist.github.com/SaptakS/03ad5dd389935499557d#file-whois-php
     * @see https://www.iana.org/domains/root/files
     * @param string $domain
     * @return string
     */
    public static function whois(string $domain): WhoisResponse
    {
        $matches = [];
        $output = [];

        $shellDomain = escapeshellarg($domain);

        $cmd1 = shell_exec(
            "whois -i {$shellDomain} | grep -i 'Registrar WHOIS Server' | cut -d: -f2 | tr -d '[:space:]'");

        $whois = escapeshellarg($cmd1);
        $cmd2 = shell_exec("whois -h {$whois} {$shellDomain} | grep :");

       

        return new WhoisResponse($output);
    }
}
