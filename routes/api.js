// import PatientController
const PatientController = require("../controllers/PatientController");

// import express
const express = require("express");

// membuat object router
const router = express.Router();

/**
 * Membuat routing
 */
router.get("/", (req, res) => {
  res.send("Hello Covid API Express");
});

// Membuat routing patient
router.get("/patients", PatientController.getAllPatients); // Route to get all patients
router.get("/patients/:id", PatientController.getPatientById); // Route to get patient by id
router.post("/patients", PatientController.createPatient); // Route to create a new patient
router.put("/patients/:id", PatientController.updatePatient); // Route to update patient by id
router.delete("/patients/:id", PatientController.deletePatient); // Route to delete patient by id

// Rute untuk mencari pasien berdasarkan nama
router.get("/patients/search/:name", PatientController.search); // Route to search patients by name

// Rute untuk mendapatkan pasien dengan status positif
router.get("/patients/positive", PatientController.positive); // Route to get patients with positive status

// Rute untuk mendapatkan pasien dengan status sembuh
router.get("/patients/recovered", PatientController.recovered); // Route to get patients with recovered status

// Rute untuk mendapatkan pasien dengan status meninggal
router.get("/patients/dead", PatientController.dead); // Route to get patients with dead status

// Rute untuk mendapatkan informasi detail tentang pasien
router.get("/patients/show/:id", PatientController.show); // Route to get detailed patient information

// export router
module.exports = router;
