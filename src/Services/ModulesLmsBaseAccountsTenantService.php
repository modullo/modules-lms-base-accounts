<?php
namespace Modullo\ModulesLmsBaseAccounts\Services;

use Hostville\Modullo\Sdk;
use Modullo\ModulesLmsBaseAccounts\Jobs\CreateLearnerJob;

class ModulesLmsBaseAccountsTenantService
{

    public function getLearners(Sdk $sdk){
        $query = $sdk->createLearnersService();
        $query = $query->addQueryArgument('limit',100);
        $path = [''];
        $response = $query->send('get',$path);
        if (!$response->isSuccessful()) {
            $response = $response->getData();
            if ($response['errors'][0]['code'] === '005') return response()->json(['error' => $response['errors'][0]['source'] ?? ''],$response['errors'][0]['status']);
            return response()->json(['error' => $response['errors'][0]['title'] ?? ''],$response['errors'][0]['status']);
        }
        return $response->getData()['users'];
    }

    public function getSingleLearner($id,Sdk $sdk){
        $query = $sdk->createLearnersService();
        $path = [$id];
        $response = $query->send('get',$path);
        if (!$response->isSuccessful()) {
            $response = $response->getData();
            if ($response['errors'][0]['code'] === '005') return response()->json(['error' => $response['errors'][0]['source'] ?? ''],$response['errors'][0]['status']);
//            return response()->json(['error' => $response['errors'][0]['title'] ?? ''],$response['errors'][0]['status']);
            return  ['error' => 'unable to fetch the requested resource'];
        }
        return $response->getData()['learner'];
    }

    public function createLearner($params, Sdk $sdk){
        $resource = $sdk->createRegistrationService();
        $resource = $resource
            ->addBodyParam('first_name',$params['first_name'])
            ->addBodyParam('last_name',$params['last_name'])
            ->addBodyParam('email',$params['email'])
            ->addBodyParam('phone_number',$params['phone_number'])
            ->addBodyParam('password',$params['password'] ?: 'pa$$word')
            ->addBodyParam('company_id',\auth()->user()->email)
            ->addBodyParam('role','lms_learner');
        $response = $resource->send('post',['']);
        if (!$response->isSuccessful()) {
            $response = $response->getData();
            if ($response['errors'][0]['code'] === '005') return response()->json(['error' => $response['errors'][0]['source'] ?? ''],$response['errors'][0]['status']);
            return response()->json(['error' => $response['errors'][0]['title'] ?? ''],$response['errors'][0]['status']);

        }

        return response()->json(['message' => 'User successfully created'],200);
    }

    public function processCSV($file,Sdk $sdk){
        $path = $file->getRealPath();
        $data = $this->csvToArray($path);

        if (count($data) > 0) {
            $send = response()->json(['message' => 'Unable to process user data'],300);
            foreach ($data as $key => $value) {
                $userData = [
                    'first_name' => $value['first_name'],
                    'last_name' => $value['last_name'],
                    'email' => $value['email'],
                    'phone_number' => $value['phone_number'],
                    'password' => $value['password'] ?: 'pa$$word',
//                    'password' => $value['password'] ?: str_random(10),
                ];

                //                $send = $this->createLearner($userData,$sdk);
                CreateLearnerJob::dispatchSync($userData,$sdk);
                $send = response()->json(['message' => 'Users successfully imported and uploading in the background.'],200);
            }
            return $send;
        }
        return response()->json(['message' => 'No user record in uploaded file'],300);
    }

    function csvToArray($filename = '', $delimiter = ',')
    {
        if (!file_exists($filename) || !is_readable($filename))
            return false;

        $header = null;
        $data = array();
        if (($handle = fopen($filename, 'r')) !== false)
        {
            while (($row = fgetcsv($handle, 1000, $delimiter)) !== false)
            {
                if (!$header)
                    $header = $row;
                else
                    $data[] = array_combine($header, $row);
            }
            fclose($handle);
        }

        return $data;
    }

    public function updateLearner($params, Sdk $sdk){
        $resource = $sdk->createLearnersService();
        $resource = $resource
            ->addBodyParam('first_name',$params['first_name'])
            ->addBodyParam('last_name',$params['last_name'])
            ->addBodyParam('phone_number',$params['phone_number'])
            ->addBodyParam('gender',$params['gender'])
            ->addBodyParam('location',$params['location']);
        if(!empty($params['password'])){
            $resource->addBodyParam('password',$params['password']);
        }
        $response = $resource->send('put',[$params['id']]);
        if (!$response->isSuccessful()) {
            $response = $response->getData();
            if ($response['errors'][0]['code'] === '005') return response()->json(['error' => $response['errors'][0]['source'] ?? ''],$response['errors'][0]['status']);
            return response()->json(['error' => $response['errors'][0]['title'] ?? ''],$response['errors'][0]['status']);

        }

        return response()->json(['message' => 'User successfully updated'],200);
    }
}
