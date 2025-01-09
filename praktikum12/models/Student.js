const db = require('../config/database');

class Student {
    static all() {
        return new Promise((resolve, reject) => {
            const query = 'SELECT * FROM students';
            db.query(query, (err, result) => {
                if (err) return reject(err);
                resolve(result);
            });
        });
    }

    static async create(data) {
        return new Promise((resolve, reject) => {
            const query = 'INSERT INTO students SET ?';
            db.query(query, data, (err, results) => {
                if (err) return reject(err);
                resolve(results);
            });
        });
    }
}

module.exports = Student;
