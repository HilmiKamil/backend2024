const Patient = require("../models/Patient");

class PatientController {
  // Get all patients
  static async getAllPatients(req, res) {
    try {
      const results = await Patient.getAllPatients();
      res.status(200).json({ data: results });
    } catch (err) {
      console.error("Database error:", err);
      res.status(500).json({ error: "Database error: " + err.message });
    }
  }

  // Get a patient by ID
  static async getPatientById(req, res) {
    const { id } = req.params;
    try {
      const result = await Patient.getPatientById(id);
      if (!result) {
        return res.status(404).json({ message: "Patient not found" });
      }
      res.status(200).json({ data: result[0] });
    } catch (err) {
      console.error("Database error:", err);
      res.status(500).json({ error: "Database error: " + err.message });
    }
  }

  // Create a new patient
  static async createPatient(req, res) {
    const { name, phone, address, status, in_date_at, out_date_at } = req.body;
    if (!name || !phone || !address || !status || !in_date_at) {
      return res.status(400).json({ message: "Please provide all required fields" });
    }
    const newPatient = { name, phone, address, status, in_date_at, out_date_at: out_date_at || null };
    try {
      const result = await Patient.createPatient(newPatient);
      res.status(201).json({ message: "Patient created successfully", data: newPatient });
    } catch (err) {
      console.error("Database error:", err);
      res.status(500).json({ error: "Database error: " + err.message });
    }
  }

  // Update an existing patient
  static async updatePatient(req, res) {
    const { id } = req.params;
    const { name, phone, address, status, in_date_at, out_date_at } = req.body;
    if (!name || !phone || !address || !status || !in_date_at) {
      return res.status(400).json({ message: "Please provide all required fields" });
    }
    const updatedPatient = { name, phone, address, status, in_date_at, out_date_at };
    try {
      const result = await Patient.updatePatient(id, updatedPatient);
      if (result.affectedRows === 0) {
        return res.status(404).json({ message: "Patient not found" });
      }
      res.status(200).json({ message: "Patient updated successfully", data: updatedPatient });
    } catch (err) {
      console.error("Database error:", err);
      res.status(500).json({ error: "Database error: " + err.message });
    }
  }

  // Delete a patient
  static async deletePatient(req, res) {
    const { id } = req.params;
    try {
      const result = await Patient.deletePatient(id);
      if (result.affectedRows === 0) {
        return res.status(404).json({ message: "Patient not found" });
      }
      res.status(200).json({ message: "Patient deleted successfully" });
    } catch (err) {
      console.error("Database error:", err);
      res.status(500).json({ error: "Database error: " + err.message });
    }
  }

  // Search patients by name
  static async search(req, res) {
    const { name } = req.params;
    try {
      const patients = await Patient.search(name);
      res.status(200).json(patients);
    } catch (error) {
      res.status(500).json({ message: 'Error searching patients', error });
    }
  }

  // Get patients with positive status
  static async positive(req, res) {
    try {
      const patients = await Patient.findByStatus('positive');
      res.status(200).json(patients);
    } catch (error) {
      res.status(500).json({ message: 'Error fetching positive patients', error });
    }
  }

  // Get patients with recovered status
  static async recovered(req, res) {
    try {
      const patients = await Patient.findByStatus('recovered');
      res.status(200).json(patients);
    } catch (error) {
      res.status(500).json({ message: 'Error fetching recovered patients', error });
    }
  }

  // Get patients with dead status
  static async dead(req, res) {
    try {
      const patients = await Patient.findByStatus('dead');
      res.status(200).json(patients);
    } catch (error) {
      res.status(500).json({ message: 'Error fetching dead patients', error });
    }
  }

  // Get detailed information of a patient
  static async show(req, res) {
    const { id } = req.params;
    try {
      const patient = await Patient.show(id);
      if (patient) {
        res.status(200).json(patient);
      } else {
        res.status(404).json({ message: 'Patient not found' });
      }
    } catch (error) {
      res.status(500).json({ message: 'Error fetching patient details', error });
    }
  }
}

module.exports = PatientController;
