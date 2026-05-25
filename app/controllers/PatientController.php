<?php

class PatientController
{
    public function index()
    {
        $patientModel = new Patient();

        $patients = $patientModel->getAll();

        Response::json(true, "Patients fetched successfully", $patients);
    }

    public function show($id)
{
    $patientModel = new Patient();

    $patient = $patientModel->findById($id);

    if (!$patient) {
        Response::json(false, "Patient not found", [], 404);
    }

    Response::json(true, "Patient fetched successfully", $patient);
}

    public function store()
    {
        $data = $_REQUEST['body'];

        if (
            empty($data['name']) ||
            empty($data['age']) ||
            empty($data['gender'])
        ) {
            Response::json(false, "Required fields missing", [], 400);
        }

        $patientModel = new Patient();

        $patientModel->create($data);

        Response::json(true, "Patient created successfully");
    }

    public function update($id)
    {
        $data = $_REQUEST['body'];

        if (
            empty($data['name']) ||
            empty($data['age']) ||
            empty($data['gender'])
        ) {
            Response::json(false, "Required fields missing", [], 400);
        }

        $patientModel = new Patient();

        $patient = $patientModel->findById($id);

        if (!$patient) {
            Response::json(false, "Patient not found", [], 404);
        }

        $patientModel->update($id, $data);

        Response::json(true, "Patient updated successfully");
    }

    public function delete($id)
    {
        $patientModel = new Patient();

        $patient = $patientModel->findById($id);

        if (!$patient) {
            Response::json(false, "Patient not found", [], 404);
        }

        $patientModel->delete($id);

        Response::json(true, "Patient deleted successfully");
    }
}