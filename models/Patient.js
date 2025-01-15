const db = require('../config/database');

class Patient {
  // Get all patients
  static async getAllPatients() {
    const query = 'SELECT * FROM patients';
    return new Promise((resolve, reject) => {
      db.query(query, (err, result) => {
        if (err) return reject(err);
        resolve(result);
      });
    });
  }

  // Get a patient by ID
  static async getPatientById(id) {
    const query = 'SELECT * FROM patients WHERE id = ?';
    return new Promise((resolve, reject) => {
      db.query(query, [id], (err, result) => {
        if (err) return reject(err);
        resolve(result);
      });
    });
  }

  // Create a new patient
  static async createPatient(data) {
    const query =
      'INSERT INTO patients (name, phone, address, status, in_date_at, out_date_at) VALUES (?, ?, ?, ?, ?, ?)';
    return new Promise((resolve, reject) => {
      db.query(
        query,
        [
          data.name,
          data.phone,
          data.address,
          data.status,
          data.in_date_at,
          data.out_date_at,
        ],
        (err, results) => {
          if (err) return reject(err);
          resolve(results);
        }
      );
    });
  }

  // Update an existing patient
  static async updatePatient(id, data) {
    const query =
      'UPDATE patients SET name = ?, phone = ?, address = ?, status = ?, in_date_at = ?, out_date_at = ? WHERE id = ?';
    return new Promise((resolve, reject) => {
      db.query(
        query,
        [
          data.name,
          data.phone,
          data.address,
          data.status,
          data.in_date_at,
          data.out_date_at,
          id,
        ],
        (err, result) => {
          if (err) return reject(err);
          resolve(result);
        }
      );
    });
  }

  // Delete a patient
  static async deletePatient(id) {
    const query = 'DELETE FROM patients WHERE id = ?';
    return new Promise((resolve, reject) => {
      db.query(query, [id], (err, result) => {
        if (err) return reject(err);
        resolve(result);
      });
    });
  }

  // Search patients by name
  static async search(name) {
    const query = 'SELECT * FROM patients WHERE name LIKE ?';
    return new Promise((resolve, reject) => {
      db.query(query, [`%${name}%`], (err, results) => {
        if (err) return reject(err);
        resolve(results);
      });
    });
  }

  // Find patients by status
  static async findByStatus(status) {
    const query = 'SELECT * FROM patients WHERE status = ?';
    return new Promise((resolve, reject) => {
      db.query(query, [status], (err, results) => {
        if (err) return reject(err);
        resolve(results);
      });
    });
  }

  // Show detailed information of a patient
  static async show(id) {
    const query = 'SELECT * FROM patients WHERE id = ?';
    return new Promise((resolve, reject) => {
      db.query(query, [id], (err, result) => {
        if (err) return reject(err);
        resolve(result[0]);
      });
    });
  }
}

module.exports = Patient;
