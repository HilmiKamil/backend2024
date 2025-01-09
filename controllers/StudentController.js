const Student = require("../models/Student");

class StudentController {
    async index(req, res) {
        const students = await Student.all();
        res.json({
            message: "Menampilkan data student",
            data: students,
        });
    }

    async store(req, res) {
        try {
            const { nama, nim, email, jurusan } = req.body;
            const newStudent = await Student.create({
                nama,
                nim,
                email,
                jurusan,
            });
            res.status(201).json({
                message: "Student created successfully",
                data: newStudent,
            });
        } catch (error) {
            res.status(500).json({ message: error.message });
        }
    }

    //Update Controllers
    async update(req, res) {
        try {
            const { id } = req.params;
            const { nama, nim, email, jurusan } = req.body;
            const updatedStudent = await Student.update(id, {
                nama,
                nim,
                email,
                jurusan,
            });
            res.json({
                message: "Student updated successfully",
                data: updatedStudent,
            });
        } catch (error) {
            res.status(500).json({ message: error.message });
        }
    }   

    //Menghapus Data
    async destroy(req, res) {
        try {
            const { id } = req.params;
            await Student.delete(id);
            res.json({ message: "Student deleted successfully" });
        } catch (error) {
            res.status(500).json({ message: error.message });
        }
    }

    //Melihat Satu Data
    async show(req, res) {
        try {
            const { id } = req.params;
            const student = await Student.find(id);
            if (!student) {
                return res.status(404).json({ message: "Student not found" });
            }
            res.json({
                message: "Menampilkan detail student",
                data: student,
            });
        } catch (error) {
            res.status(500).json({ message: error.message });
        }
    }

}

module.exports = new StudentController();
