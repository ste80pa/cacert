<?php
namespace App\Utils;

use App\Entity\Email;
use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Registry;
use App\Validator\DomainValidator;

/**
 */
class Cacert
{

    /**
     *
     * @var \Twig_Environment
     */
    private $twig;

    /**
     *
     * @var Registry
     */
    private $doctrine;

    /**
     *
     * @param Registry $doctrine
     * @param \Twig_Environment $twig
     */
    public function __construct(Registry $doctrine, \Twig_Environment $twig)
    {
        $this->twig = $twig;
        $this->doctrine = $doctrine;
    }

    /**
     * Send registration mail templates/emails/registration.html.twig
     */
    public function sendRegistrationMail(User $user, Email $email)
    {
        $to = $user->getEmail();
        $message = (new \Swift_Message('Hello Email'))->setFrom('send@example.com')
            ->setTo($to)
            ->setBody(
            $this->twig->render('emails/registration.html.twig',
                [
                    'user' => $user,
                    'email' => $email
                ]), 'text/html')
            ->addPart(
            $this->twig->render('emails/registration.txt.twig',
                [
                    'user' => $user,
                    'email' => $email
                ]), 'text/plain');
    }

    public static function getTranslations()
    {
        return [
            "ar" => "&#1575;&#1604;&#1593;&#1585;&#1576;&#1610;&#1577;",
            "bg" => "&#1041;&#1098;&#1083;&#1075;&#1072;&#1088;&#1089;&#1082;&#1080;",
            "cs" => "&#268;e&scaron;tina",
            "da" => "Dansk",
            "de" => "Deutsch",
            "el" => "&Epsilon;&lambda;&lambda;&eta;&nu;&iota;&kappa;&#940;",
            "en" => "English",
            "es" => "Espa&#xf1;ol",
            "fi" => "Suomi",
            "fr" => "Fran&#xe7;ais",
            "hu" => "Magyar",
            "it" => "Italiano",
            "ja" => "&#26085;&#26412;&#35486;",
            "lv" => "Latvie&scaron;u",
            "nl" => "Nederlands",
            "pl" => "Polski",
            "pt" => "Portugu&#xea;s",
            "pt-br" => "Portugu&#xea;s Brasileiro",
            "ru" => "&#x420;&#x443;&#x441;&#x441;&#x43a;&#x438;&#x439;",
            "sv" => "Svenska",
            "tr" => "T&#xfc;rk&#xe7;e",
            "zh-cn" => "&#x4e2d;&#x6587;(&#x7b80;&#x4f53;)",
            "zh-tw" => "&#x4e2d;&#x6587;(&#33274;&#28771;)"
        ];
    }

    /**
     */
    public function makeHash(): string
    {
        $hash = null;

        if (function_exists("dio_open")) {
            $rnd = dio_open("/dev/urandom", O_RDONLY);
            $hash = md5(dio_read($rnd, 64));
            dio_close($rnd);
        } else {
            $rnd = fopen("/dev/urandom", "r");
            $hash = md5(fgets($rnd, 64));
            fclose($rnd);
        }
        return $hash;
    }

    /**
     * uniqueID`=SHA1(CONCAT(NOW(),'$hash'))
     */
    public function generateUniqueId(string $hash): string
    {
        return sha1((new \DateTime('NOW'))->format('Y-m-d H:i:s') . $hash);
    }

    /**
     *
     * @param string $domain
     *            Already validated domain with @see DomainValidator
     */
    public function getEmailsForDomainValidation(string $domain)
    {
        $addy = array();
        $adds = array();
        $domain = trim($domain);
        $shellDomain = escapeshellarg($domain);

        // "/usr/bin/whois {$shellDomain} | grep @ | cut -d : -f 2 | tr -d '[\ ]' | sort -u"
        if (strtolower(substr($domain, - 4, 3)) != '.jp') {
            $adds = explode("\n", trim(shell_exec("/usr/bin/whois {$shellDomain}|grep \"@\"")));
        }

        if (substr($domain, - 4) == '.org' || substr($domain, - 5) == '.info') {
            if (is_array($adds)) {
                foreach ($adds as $line) {
                    $bits = explode(':', $line, 2);
                    $line = trim($bits[1]);
                    if (! in_array($line, $addy) && $line != '') {
                        $addy[] = trim(stripslashes($line));
                    }
                }
            }
        } else {
            if (is_array($adds)) {
                foreach ($adds as $line) {
                    $line = trim(str_replace("\t", ' ', $line));
                    $line = trim(str_replace('(', ' ', $line));
                    $line = trim(str_replace(')', ' ', $line));
                    $line = trim(str_replace(':', ' ', $line));

                    $bits = explode(' ', $line);
                    foreach ($bits as $bit) {
                        if (strstr($bit, '@')) {
                            $line = $bit;
                        }
                    }
                    if (! in_array($line, $addy) && $line != '') {
                        $addy[] = trim(stripslashes($line));
                    }
                }
            }
        }

        $rfc = array(
            "root@{$domain}",
            "hostmaster@{$domain}",
            "postmaster@{$domain}",
            "admin@{$domain}",
            "webmaster@{$domain}"
        );

        foreach ($rfc as $sub) {
            if (! in_array($sub, $addy)) {
                $addy[] = $sub;
            }
        }

        return $addy;
    }

    public function addEmailAddress($emailAddress)
    {
        // $_REQUEST['newemail']
        if (strstr($emailAddress, "xn--") && $_SESSION['profile']['codesign'] <= 0) {
            throw new \Exception(null, \Exception::PUNYCODE_NOT_ALLOWED);
        }

        if (trim(mysql_real_escape_string(stripslashes($_REQUEST['newemail']))) == "") {
            showheader(_("My CAcert.org Account!"));
            printf(_("Not a valid email address. Can't continue."));
            showfooter();
            exit();
        }
        $oldid = 0;
        $_REQUEST['email'] = trim(mysql_real_escape_string(stripslashes($_REQUEST['newemail'])));
        if (check_email_exists($_REQUEST['email']) == true) {
            showheader(_("My CAcert.org Account!"));
            printf(_("The email address '%s' is already in a different account. Can't continue."),
                sanitizeHTML($_REQUEST['email']));
            showfooter();
            exit();
        }
        $checkemail = checkEmail($_REQUEST['newemail']);
        if ($checkemail != "OK") {
            showheader(_("My CAcert.org Account!"));
            if (substr($checkemail, 0, 1) == "4") {
                echo "<p>" .
                    _(
                        "The mail server responsible for your domain indicated a temporary failure. This may be due to anti-SPAM measures, such as greylisting. Please try again in a few minutes.") .
                    "</p>\n";
            } else {
                echo "<p>" .
                    _(
                        "Email Address given was invalid, or a test connection couldn't be made to your server, or the server rejected the email address as invalid") .
                    "</p>\n";
            }
            echo "<p>$checkemail</p>\n";
            showfooter();
            exit();
        }
        $hash = make_hash();
        $query = "insert into `email` set `email`='" . $_REQUEST['email'] . "',`memid`='" .
            intval($_SESSION['profile']['id']) . "',`created`=NOW(),`hash`='$hash'";
        mysql_query($query);
        $emailid = mysql_insert_id();

        $body = _(
            "Below is the link you need to open to verify your email address. Once your address is verified you will be able to start issuing certificates to your heart's content!") .
            "\n\n";
        $body .= "http://" . $_SESSION['_config']['normalhostname'] .
            "/verify.php?type=email&emailid=$emailid&hash=$hash\n\n";
        $body .= _("Best regards") . "\n" . _("CAcert.org Support!");

        sendmail($_REQUEST['email'], "[CAcert.org] " . _("Email Probe"), $body, "support@cacert.org", "", "",
            "CAcert Support");

        // showheader(_("My CAcert.org Account!"));
        // printf(_("The email address '%s' has been added to the system, however before any certificates for this can
        // be issued you need to open the link in a browser that has been sent to your email address."),
        // sanitizeHTML($_REQUEST['email']));
        // showfooter();
        // exit;
    }

    /**
     *
     * @param string $email
     * @return unknown|string
     */
    public function checkEmail(string $email)
    {
        if (preg_match("/^([a-zA-Z0-9])+([a-zA-Z0-9\+\._-])*@([a-zA-Z0-9_-])+([a-zA-Z0-9\._-]+)+$/", $email)) {
            list ($username, $domain) = explode('@', $email, 2);
            $mxhostrr = array();
            $mxweight = array();
            if (! getmxrr($domain, $mxhostrr, $mxweight)) {
                $mxhostrr = array(
                    $domain
                );
                $mxweight = array(
                    0
                );
            } else if (empty($mxhostrr)) {
                $mxhostrr = array(
                    $domain
                );
                $mxweight = array(
                    0
                );
            }

            $mxhostprio = array();
            for ($i = 0; $i < count($mxhostrr); $i ++) {
                $mx_host = trim($mxhostrr[$i], '.');
                $mx_prio = $mxweight[$i];
                if (empty($mxhostprio[$mx_prio])) {
                    $mxhostprio[$mx_prio] = array();
                }
                $mxhostprio[$mx_prio][] = $mx_host;
            }

            array_walk($mxhostprio, function (&$mx) {
                shuffle($mx);
            });
            ksort($mxhostprio);

            $mxhosts = array();
            foreach ($mxhostprio as $mx_prio => $mxhostnames) {
                foreach ($mxhostnames as $mx_host) {
                    $mxhosts[] = $mx_host;
                }
            }

            foreach ($mxhosts as $key => $domain) {
                $fp_opt = array(
                    'ssl' => array(
                        'verify_peer' => false // Opportunistic Encryption
                    )
                );
                $fp_ctx = stream_context_create($fp_opt);
                $fp = @stream_socket_client("tcp://{$domain}:25", $errno, $errstr, 5, STREAM_CLIENT_CONNECT, $fp_ctx);
                if ($fp) {
                    stream_set_blocking($fp, true);

                    $has_starttls = false;

                    do {
                        $line = fgets($fp, 4096);
                    } while (substr($line, 0, 4) == "220-");
                    if (substr($line, 0, 3) != "220") {
                        fclose($fp);
                        continue;
                    }

                    fputs($fp, "EHLO www.cacert.org\r\n");
                    do {
                        $line = fgets($fp, 4096);
                        $has_starttls |= substr(trim($line), 4) == "STARTTLS";
                    } while (substr($line, 0, 4) == "250-");
                    if (substr($line, 0, 3) != "250") {
                        fclose($fp);
                        continue;
                    }

                    if ($has_starttls) {
                        fputs($fp, "STARTTLS\r\n");
                        do {
                            $line = fgets($fp, 4096);
                        } while (substr($line, 0, 4) == "220-");
                        if (substr($line, 0, 3) != "220") {
                            fclose($fp);
                            continue;
                        }

                        stream_socket_enable_crypto($fp, true, STREAM_CRYPTO_METHOD_TLS_CLIENT);

                        fputs($fp, "EHLO www.cacert.org\r\n");
                        do {
                            $line = fgets($fp, 4096);
                        } while (substr($line, 0, 4) == "250-");
                        if (substr($line, 0, 3) != "250") {
                            fclose($fp);
                            continue;
                        }
                    }

                    fputs($fp, "MAIL FROM:<returns@cacert.org>\r\n");
                    do {
                        $line = fgets($fp, 4096);
                    } while (substr($line, 0, 4) == "250-");
                    if (substr($line, 0, 3) != "250") {
                        fclose($fp);
                        continue;
                    }

                    fputs($fp, "RCPT TO:<$email>\r\n");
                    do {
                        $line = fgets($fp, 4096);
                    } while (substr($line, 0, 4) == "250-");
                    if (substr($line, 0, 3) != "250") {
                        fclose($fp);
                        continue;
                    }

                    fputs($fp, "QUIT\r\n");
                    fclose($fp);

                    $line = mysql_real_escape_string(trim(strip_tags($line)));
                    $query = "insert into `pinglog` set `when`=NOW(), `email`='$email', `result`='$line'";
                   
                    
                    if (is_array($_SESSION['profile']))
                        $query .= ", `uid`='" . intval($_SESSION['profile']['id']) . "'";
                    mysql_query($query);

                    if (substr($line, 0, 3) != "250")
                        return $line;
                    else
                        return "OK";
                }
            }
        }
        $query = "insert into `pinglog` set `when`=NOW(), `uid`='" . intval($_SESSION['profile']['id']) . "',
				`email`='$myemail', `result`='Failed to make a connection to the mail server'";
        mysql_query($query);
        return _("Failed to make a connection to the mail server");
    }
}
