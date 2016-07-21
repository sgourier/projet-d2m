var root_url = "http://d2m.macroprog.com/";
var admin_url = root_url + "admin";

var questionMessage = 'question test';
var responseMessage = 'response test';

casper.test.begin('Questions test', 42, function suite(test) {
    casper.start(root_url, function checkGetIndex(){
        test.assertHttpStatus(200, 'Index loaded');
    })
    .then(checkMemberAskQuestion)
    .then(checkAdminAssignsQuestionToExpert)
    .then(checkExpertRespond)
    .then(checkDiscussionIsCorrectlyDisplayedOnMemberProfile)
    casper.run(function(){
        test.done();
    });

    function checkMemberAskQuestion() {
        casper.then(function checkGoToLoginPage() {
            test.assertExists('a.button-login', "Login button found");
            this.mouse.click("a.button-login");
            this.waitForSelector('input[id="username"]');
        })
        .then(function checkLoginMemberWorks() {
            test.assertUrlMatch(/login/, "Login page loaded");
            test.assertExists('input[id="username"]', "Username input found");
            test.assertExists('input[id="password"]', "Password input found");
            casper.sendKeys('input[id="username"]', 'member');
            casper.sendKeys('input[id="password"]', 'member');
            this.mouse.click('input[value="Connexion"]');
            this.waitForSelector('a[href="/profile/"]', function() {
               test.assertExists('a[href="/profile/"]', "Member login worked"); 
            });
        })
        .then(function checkGoToNewQuestionPage() {
            this.evaluate(function() {
                 document.querySelector('a[href="/questions_new"]').click();
            });
            casper.waitForUrl('/questions_new', function() {
                test.assertTextExists('Posez votre question :', "NewQuestion page loaded"); 
            });
        })
        .then(function checkAskNewQuestion() {
            test.assertExists('textarea#message_text', "Question message found");
            casper.sendKeys('textarea#message_text', questionMessage);
            this.evaluate(function() {
                document.getElementById("message_save").click();
            });
            casper.waitForUrl(/questions_confirm/, function () {
                test.assertTextExists('Question enregistrée !', "Question saved"); 
            });
        })
        .then(function checkLogoutMember() {
            test.assertExists('a.button-logout', "Logout button found");
            this.mouse.click('a.button-logout');
            this.waitForSelector('a[href="/login"]', function() {
                test.assertExists('a[href="/login"]', "Member logout worked"); 
            });
        });
    }
    
    function checkAdminAssignsQuestionToExpert() {
        casper.then(function checkGoToLoginPage() {
            test.assertExists('a.button-login', "Login button found");
            this.mouse.click("a.button-login");
            this.waitForSelector('input[id="username"]');
        })
        .then(function checkLoginMemberWorks() {
            test.assertUrlMatch(/login/, "Login page loaded");
            test.assertExists('input[id="username"]', "Username input found");
            test.assertExists('input[id="password"]', "Password input found");
            casper.sendKeys('input[id="username"]', 'admin');
            casper.sendKeys('input[id="password"]', 'admin');
            this.mouse.click('input[value="Connexion"]');
            this.waitForSelector('a[href="/profile/"]', function() {
               test.assertExists('a[href="/profile/"]', "Admin login worked"); 
            });
        })
        .thenOpen(root_url+'admin')
        .then(function checkAdminPageLoaded() {
             test.assertTextExists('Vimolia Admin', "Admin page loaded"); 
        })
        .then(function checkGoToQuestionsPage() {
            this.evaluate(function() {
                document.querySelector('a[href="/admin/newQuestions"]').click();
            });
            casper.waitForUrl(/admin\/newQuestions/, function () {
                test.assertTextExists('Liste des nouvelles questions', "Admin > questions page loaded"); 
            });
        })
        .then(function checkGoToLastQuestionPage() {
            this.evaluate(function() {
                 document.querySelector('#container-discussion > table > tbody > tr:nth-child(1) > td:nth-child(3) > a').click();
            });
            casper.waitForText('Question posée par le membre', function() {
                test.assertTextExists(questionMessage, "Admin > member question page loaded"); 
            });
        })
        .then(function checkAdminAttributesToExpert() {
            this.evaluate(function() {
                document.querySelector('#container-discussion > form > button').click();
            });
            casper.waitForUrl(/admin\/newQuestions/, function () {
                test.assertTextExists('Liste des nouvelles questions', "Admin > question assigned to expert by admin"); 
            });
        })
        .thenOpen(root_url)
        .then(function checkLogoutMember() {
            test.assertExists('a.button-logout', "Logout button found");
            this.mouse.click('a.button-logout');
            this.waitForSelector('a[href="/login"]', function() {
                test.assertExists('a[href="/login"]', "Admin logout worked"); 
            });
        });
    }
    
    function checkExpertRespond() {
        casper.then(function checkGoToLoginPage() {
            test.assertExists('a.button-login', "Login button found");
            this.mouse.click("a.button-login");
            this.waitForSelector('input[id="username"]');
        })
        .then(function checkLoginMemberWorks() {
            test.assertUrlMatch(/login/, "Login page loaded");
            test.assertExists('input[id="username"]', "Username input found");
            test.assertExists('input[id="password"]', "Password input found");
            casper.sendKeys('input[id="username"]', 'expert');
            casper.sendKeys('input[id="password"]', 'expert');
            this.mouse.click('input[value="Connexion"]');
            this.waitForSelector('a[href="/profile/"]', function() {
               test.assertExists('a[href="/profile/"]', "Expert login worked"); 
            });
        })
        .thenOpen(root_url+'admin')
        .then(function checkAdminPageLoaded() {
             test.assertTextExists('Vimolia Admin', "Admin page loaded"); 
        })
        .then(function checkGoToQuestionsPage() {
            this.evaluate(function() {
                document.querySelector('a[href="/admin/myQuestions"]').click();
            });
            casper.waitForUrl(/admin\/myQuestions/, function () {
                test.assertTextExists('Liste de vos questions en attentes', "Admin > questions page loaded"); 
            });
        })
        .then(function checkGoToLastQuestionPage() {
            this.evaluate(function() {
                 document.querySelector('#container-discussion > table > tbody > tr:nth-child(1) > td.grey.td-button > a').click();
            });
            casper.waitForText('Question posée par le membre', function() {
                test.assertTextExists(questionMessage, "Admin > member question page loaded"); 
            });
        })
        .then(function checkExpertRepond() {
            casper.sendKeys('textarea#reponse_text', responseMessage);
            this.evaluate(function() {
                document.getElementById("reponse_save").click();
            });
            casper.waitForUrl(/admin\/myQuestions/, function () {
                test.assertTextExists('Liste de vos questions en attentes', "Admin > Expert responded to member"); 
            });
        })
        .thenOpen(root_url)
        .then(function checkLogoutMember() {
            test.assertExists('a.button-logout', "Logout button found");
            this.mouse.click('a.button-logout');
            this.waitForSelector('a[href="/login"]', function() {
                test.assertExists('a[href="/login"]', "Expert logout worked"); 
            });
        });
    }
    
    function checkDiscussionIsCorrectlyDisplayedOnMemberProfile() {
        casper.then(function checkGoToLoginPage() {
            test.assertExists('a.button-login', "Login button found");
            this.mouse.click("a.button-login");
            this.waitForSelector('input[id="username"]');
        })
        .then(function checkLoginMemberWorks() {
            test.assertUrlMatch(/login/, "Login page loaded");
            test.assertExists('input[id="username"]', "Username input found");
            test.assertExists('input[id="password"]', "Password input found");
            casper.sendKeys('input[id="username"]', 'member');
            casper.sendKeys('input[id="password"]', 'member');
            this.mouse.click('input[value="Connexion"]');
            this.waitForSelector('a[href="/profile/"]', function() {
               test.assertExists('a[href="/profile/"]', "Member login worked"); 
            });
        })
        .then(function checkGoToProfilePage() {
            this.evaluate(function() {
                 document.querySelector('a[href="/profile/"]').click();
            });
            casper.waitForUrl('/profile/', function() {
                test.assertTextExists('Mes questions', "Member profile page loaded"); 
            });
        })
        .then(function checkGoToMemberQuestionsPage() {
            this.evaluate(function() {
                 document.querySelector('a[href="/profile/questions"]').click();
            });
            casper.waitForUrl('/profile\/questions', function() {
                test.assertTextExists('Liste de vos questions', "Member questions page loaded"); 
            });
        })
        .then(function checkGoToMemberLastQuestionPage() {
            this.evaluate(function() {
                 document.querySelector('#container-discussion > table > tbody > tr:nth-child(1) > td.grey.td-button > a').click();
            });
            casper.waitForText('Votre question', function() {
                test.assertTextExists(questionMessage, "Question correctly displayed on member profile");
                test.assertTextExists(responseMessage, "Response correctly displayed on member profile"); 
            });
        });
    }
    
});