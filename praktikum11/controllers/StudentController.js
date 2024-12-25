const students = require("../data/students");

class StudentController {
    index(req, res) {
        const data = {
            message: "Menampilkan data student",
            data: students,
        };

        res.json(data);
    };
    
    store(req, res) {
        const {nama} = req.body;
        const data = {
            message: `Mengedit data student ${nama}`,
            data: students,
        };
        res.json(data);
    };
    
    update(req, res) {
        const {id} = req.params;
        const {nama} = req.body;
        const data = {
            message: `Mengedit data student id ${id}, nama ${nama}`,
            data: students,
        };  
        res.json(data);
    };
    
    destroy(req, res) {
        const {id} = req.params;
        const data = {
            message: `Menghapus data student id ${id}`,
            data: students,
        };
        res.json(data);
    }
}

const object = new StudentController();

module.exports = object;