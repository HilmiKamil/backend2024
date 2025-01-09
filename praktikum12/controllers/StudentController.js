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
}

module.exports = new StudentController();
