const express = require('express');
const router = express.Router();
const loginController = require('../controllers/login.controller');
const homeController = require('../controllers/home.controller');
const {removeToken} = require('../utils/cookie');



const notImplement = (req, res) => {
    return res.json({ message: 'Aun no se implementa' });
}


router.get('/', loginController.get);
router.route('/login')
    .get(loginController.get)
    .post(loginController.post);


router.get('/logout', async (req, res) => {
    await removeToken(res);
    res.redirect('/');
});

router.get('/resetPassword', notImplement);
router.get('/home', homeController.get)

module.exports = router;