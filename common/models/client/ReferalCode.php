<?php
namespace common\models\client;

final class ReferalCode
{
    const REF_SALT = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.';

    public function createReferalCode($clientId,...$items)
    {
        return $this->calculateReferalCode($clientId, $items);
    }

    public function checkReferalCode()
    {

    }

    private function calculateReferalCode($clientId, ...$items)
    {
        $referalCode = "AORL-";
        $code = '';

        foreach($items as $item) {
            $code .= "{$item}";
        }
        return $referalCode . hash($code) . "-{$clientId}";
    }
}