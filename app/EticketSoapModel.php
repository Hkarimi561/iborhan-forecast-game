<?php

namespace App;

use Artisaninweb\SoapWrapper\Extension\SoapService;

class EticketSoapModel extends SoapService
{
    protected $name = 'eticket';
    protected $wsdl = 'http://89.165.5.100/FootballTicketService.asmx?wsdl';
    protected $trace = true;



    public function functions()
    {
        return $this->getFunctions();
    }

    public function getMatches()
    {
        return $this->call('GetMatchs', [])->GetMatchsResult;
    }
    public function getPositions($data)
    {
        return $this->call('GetPositions', [$data])->GetPositionsResult;
    }

    public function getSections($data)
    {
        return $this->call('GetSections', [$data])->GetSectionsResult;
    }
    public function getSeats($data)
    {
        return $this->call('GetSeats', [$data])->GetSeatsResult;
    }

    public function getUserValidate($data)
    {
        return $this->call('UserValidation', [$data])->UserValidationResult;
    }
    public function setSeatReseve($data)
    {
        return $this->call('SetSeatReseve', [$data])->SetSeatReseveResult;
    }
    public function setSeatCardNumber($data)
    {
        return $this->call('SetSeatCardNumber', [$data])->SetSeatCardNumberResult;
    }
    public function startPayment($data)
    {
        return $this->call('StartPayment', [$data])->StartPaymentResult;
    }
}
