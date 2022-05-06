<?php

namespace frontend\actions\cuba;

use common\models\client\Client;
use common\models\client\ClientContact;
use yii\base\Action;
use Yii;

class SaveCustomerAction extends Action
{
    /**
     * @return void
     */
    public function run(): void
    {
        $data = Yii::$app->request->post('Registration');
        $tr = Yii::$app->db->beginTransaction();

        try{
            $client = $this->saveClient($data);
            $client->updateAuthKey();
            $this->saveClientPassword($client, $data);
            $this->saveClientContactData($client, $data);
            $this->saveClientEducation($client, $data);
            $this->saveClientJobs($client, $data);

            $tr->commit();
        } catch(\Exception $ex) {
            $tr->rollBack();
        }
    }

    /**
     * @param array $data
     * @return Client
     */
    private function saveClient(array $data): Client
    {
        $client = new Client();
        $client->email = $data['email'];
        $client->name_first = $data['firstName'];
        $client->name_last = $data['lastName'];
        $client->maiden_name = $data['maidenNamePatronymic'];
        $client->ssn = $data['ssn'];
        $client->adegree_before = $data['academicDegree'];
        $client->gender = $data['sex'];
        $client->birth_place = $data['birthPlace'];
        $client->birth_date = (new \DateTimeImmutable($data['birthDate']))->format('Y-m-d');
        $client->status=1;
        $client->save();
        return $client;
    }

    /**
     * @param Client $client
     * @param array $data
     * @return void
     * @throws \yii\base\Exception
     */
    private function saveClientPassword(Client $client, array $data): void
    {
        $client->password_hash = Yii::$app->security->generatePasswordHash($data['pass']);
        $client->save();
    }

    /**
     * @param Client $client
     * @param array $data
     * @return void
     */
    private function saveClientContactData(Client $client, array $data): void
    {
        $clientData = new ClientContact();
        $clientData->client_id = $client->id;
        $clientData->mobile_area_code = $data['phone']['countryCode'];
        $clientData->mobile = $data['phone']['number'];
        $clientData->perm_country = $data['permanent_address']['country'];
        $clientData->perm_zip = $data['permanent_address']['zip'];
        $clientData->perm_town = $data['permanent_address']['town'];
        $clientData->perm_street = $data['permanent_address']['address1'];
        $clientData->perm_street2 = $data['permanent_address']['address2'] ?? '';
        $clientData->temp_country = $data[]['country'];
        $clientData->temp_zip = $data[]['zip'];
        $clientData->temp_town = $data[]['town'];
        $clientData->temp_street = $data[]['address1'];
        $clientData->temp_street2 = $data[]['address2'] ?? '';

        $clientData->save();
    }

    /**
     * @param Client $client
     * @param array $data
     * @return void
     */
    private function saveClientEducation(Client $client, array $data): void
    {

    }

    /**
     * @param Client $client
     * @param array $data
     * @return void
     */
    private function saveClientJobs(Client $client, array $data): void
    {

    }

    private function saveClientLanguages(Client $client, array $data): void
    {

    }

    private function saveClientOtherKnowledges(Client $client, array $data): void
    {

    }

    private function saveClientRequestedServices(Client $client, array $data): void
    {

    }

}