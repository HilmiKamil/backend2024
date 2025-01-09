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

    static async update(id, data) {
        await new Promise((resolve, reject) => {
            const sql = 'UPDATE students SET ? WHERE id = ?';
            db.query(sql, [data, id], (err, results) => {
                resolve(results);
            });
        });

        //mencari data baru yang di update
        const student = await this.find(id);
        return student;
    }

    //Menghapus data dari Database
    static delete(id) {
        return new Promise((resolve, reject) => {
            const sql = 'DELETE FROM students WHERE id = ?';
            db.query(sql, id, (err, results) => {
                resolve(results);
            });
        });
    }

    //Mendapatkan shown dengan satu id
    static find(id) {
        return new Promise((resolve, reject) => {
            const sql = 'SELECT * FROM students WHERE id = ?';
            db.query(sql, id, (err, results) => {
                //destructing array
                const [student] = results;
                resolve(student);
            });
        });
    }
}

module.exports = Student;
