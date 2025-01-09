const StudentController = require("../controllers/StudentController");

const express = require("express");
const router = express.Router();

router.get("/", (req, res) => {
    res.send("Hello Express");
});

router.get("/students", StudentController.index);
router.post("/students", StudentController.store);

module.exports = router;
