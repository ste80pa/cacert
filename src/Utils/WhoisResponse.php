<?php
namespace App\Utils;

/**
 * In future will be surclassed by RDAP (Registration Data Access Protocol) 
 * @link https://www.icann.org/rdap
 * @author Stefano Pallozzi
 *        
 */
class WhoisResponse
{

    /**
     *
     * @var array
     */
    protected $fields = [
        
    ];

    /**
     *
     * @param string $result
     */
    public function __construct(string $result)
    {
        $matches = [];
        $fields = [];

        preg_match_all('/(^\w[\w\s\/]+):[ ]*(.+)/m', $result, $matches, PREG_SET_ORDER, 0);

        foreach ($matches as $m) {
            if (isset($fields[$m[1]])) {
                if (is_array($fields[$m[1]])) {
                    $fields[$m[1]][] = $m[2];
                } else {
                    $v = $fields[$m[1]];
                    $fields[$m[1]] = [
                        $v,
                        $m[2]
                    ];
                }
            } else {
                $fields[$m[1]] = $m[2];
            }
        }

        $this->fields = $fields;
    }

    /**
     *
     * @return string Domain Name
     */
    public function getDomainName()
    {
        return $this->fields['Domain Name'];
    }

    /**
     *
     * @return string Registry Domain ID
     */
    public function getRegistryDomainID()
    {
        return $this->fields['Registry Domain ID'];
    }

    /**
     *
     * @return string Registrar WHOIS Server
     */
    public function getRegistrarWHOISServer()
    {
        return $this->fields['Registrar WHOIS Server'];
    }

    /**
     *
     * @return string Registrar URL
     */
    public function getRegistrarURL()
    {
        return $this->fields['Registrar URL'];
    }

    /**
     *
     * @return string Updated Date
     */
    public function getUpdatedDate()
    {
        return $this->fields['Updated Date'];
    }

    /**
     *
     * @return string Creation Date
     */
    public function getCreationDate()
    {
        return $this->fields['Creation Date'];
    }

    /**
     *
     * @return string Registrar Registration Expiration Date
     */
    public function getRegistrarRegistrationExpirationDate()
    {
        return $this->fields['Registrar Registration Expiration Date'];
    }

    /**
     *
     * @return string Registrar
     */
    public function getRegistrar()
    {
        return $this->fields['Registrar'];
    }

    /**
     *
     * @return string Registrar IANA ID
     */
    public function getRegistrarIANAID()
    {
        return $this->fields['Registrar IANA ID'];
    }

    /**
     *
     * @return string Registrar Abuse Contact Email
     */
    public function getRegistrarAbuseContactEmail()
    {
        return $this->fields['Registrar Abuse Contact Email'];
    }

    /**
     *
     * @return string Registrar Abuse Contact Phone
     */
    public function getRegistrarAbuseContactPhone()
    {
        return $this->fields['Registrar Abuse Contact Phone'];
    }

    /**
     *
     * @return string Domain Status
     */
    public function getDomainStatus()
    {
        return $this->fields['Domain Status'];
    }

    /**
     *
     * @return string Registry Registrant ID
     */
    public function getRegistryRegistrantID()
    {
        return $this->fields['Registry Registrant ID'];
    }

    /**
     *
     * @return string Registrant Name
     */
    public function getRegistrantName()
    {
        return $this->fields['Registrant Name'];
    }

    /**
     *
     * @return string Registrant Organization
     */
    public function getRegistrantOrganization()
    {
        return $this->fields['Registrant Organization'];
    }

    /**
     *
     * @return string Registrant Street
     */
    public function getRegistrantStreet()
    {
        return $this->fields['Registrant Street'];
    }

    /**
     *
     * @return string Registrant City
     */
    public function getRegistrantCity()
    {
        return $this->fields['Registrant City'];
    }

    /**
     *
     * @return string Registrant State/Province
     */
    public function getRegistrantStateOrProvince()
    {
        return $this->fields['Registrant State/Province'];
    }

    /**
     *
     * @return string Registrant Postal Code
     */
    public function getRegistrantPostalCode()
    {
        return $this->fields['Registrant Postal Code'];
    }

    /**
     *
     * @return string Registrant Country
     */
    public function getRegistrantCountry()
    {
        return $this->fields['Registrant Country'];
    }

    /**
     *
     * @return string Registrant Phone
     */
    public function getRegistrantPhone()
    {
        return $this->fields['Registrant Phone'];
    }

    /**
     *
     * @return string Registrant Fax
     */
    public function getRegistrantFax()
    {
        return $this->fields['Registrant Fax'];
    }

    /**
     *
     * @return string Registrant Email
     */
    public function getRegistrantEmail()
    {
        return $this->fields['Registrant Email'];
    }

    /**
     *
     * @return string Admin Name
     */
    public function getAdminName()
    {
        return $this->fields['Admin Name'];
    }

    /**
     *
     * @return string Admin Organization
     */
    public function getAdminOrganization()
    {
        return $this->fields['Admin Organization'];
    }

    /**
     *
     * @return string Admin Street
     */
    public function getAdminStreet()
    {
        return $this->fields['Admin Street'];
    }

    /**
     *
     * @return string Admin City
     */
    public function getAdminCity()
    {
        return $this->fields['Admin City'];
    }

    /**
     *
     * @return string Admin State/Province
     */
    public function getAdminStateOrProvince()
    {
        return $this->fields['Admin State/Province'];
    }

    /**
     *
     * @return string Admin Postal Code
     */
    public function getAdminPostalCode()
    {
        return $this->fields['Admin Postal Code'];
    }

    /**
     *
     * @return string Admin Country
     */
    public function getAdminCountry()
    {
        return $this->fields['Admin Country'];
    }

    /**
     *
     * @return string Admin Phone
     */
    public function getAdminPhone()
    {
        return $this->fields['Admin Phone'];
    }

    /**
     *
     * @return string Admin Fax
     */
    public function getAdminFax()
    {
        return $this->fields['Admin Fax'];
    }

    /**
     *
     * @return string Admin Email
     */
    public function getAdminEmail()
    {
        return $this->fields['Admin Email'];
    }

    /**
     *
     * @return string Tech Name
     */
    public function getTechName()
    {
        return $this->fields['Tech Name'];
    }

    /**
     *
     * @return string Tech Organization
     */
    public function getTechOrganization()
    {
        return $this->fields['Tech Organization'];
    }

    /**
     *
     * @return string Tech Street
     */
    public function getTechStreet()
    {
        return $this->fields['Tech Street'];
    }

    /**
     *
     * @return string Tech City
     */
    public function getTechCity()
    {
        return $this->fields['Tech City'];
    }

    /**
     *
     * @return string Tech State/Province
     */
    public function getTechStateOrProvince()
    {
        return $this->fields['Tech State/Province'];
    }

    /**
     *
     * @return string Tech Postal Code
     */
    public function getTechPostalCode()
    {
        return $this->fields['Tech Postal Code'];
    }

    /**
     *
     * @return string Tech Country
     */
    public function getTechCountry()
    {
        return $this->fields['Tech Country'];
    }

    /**
     *
     * @return string Tech Phone
     */
    public function getTechPhone()
    {
        return $this->fields['Tech Phone'];
    }

    /**
     *
     * @return string Tech Fax
     */
    public function getTechFax()
    {
        return $this->fields['Tech Fax'];
    }

    /**
     *
     * @return string Tech Fax Ext
     */
    public function getTechFaxExt()
    {
        return $this->fields['Tech Fax Ext'];
    }

    /**
     *
     * @return string Tech Email
     */
    public function getTechEmail()
    {
        return $this->fields['Tech Email'];
    }

    /**
     *
     * @return string Name Server
     */
    public function getNameServer()
    {
        return $this->fields['Name Server'];
    }

    /**
     *
     * @return string DNSSEC
     */
    public function getDNSSEC()
    {
        return $this->fields['DNSSEC'];
    }

    /**
     *
     * @return string URL of the ICANN WHOIS Data Problem Reporting System
     */
    public function getURLoftheICANNWHOISDataProblemReportingSystem()
    {
        return $this->fields['URL of the ICANN WHOIS Data Problem Reporting System'];
    }
}