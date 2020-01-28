/**
 * This class controls a gameplay experiment where the player is
 * invited to play all the games, one after another, while
 * some data are collected (facial expressions, etc).
 */

var FTG = FTG || {};

FTG.Experiment = function() {

    this.mUid;
    this.mCurrentPhrase;
    this.mRestTime = 2.3; // in minutes
    this.delayTimeAudacity = 5; // Seconds
    this.mStarTime; // Seconds
    this.mDebug;
    this.mFinished;
    this.mData;
    this.mBipSound;
    this.mTanSound;
    this.mCalmSound;

    // Initialize the whole thing up
    this.init();
};

// Singleton that will be used by all games
FTG.Experiment.instance = null;

// Methods

FTG.Experiment.prototype.init = function() {
    this.mUid = FTG.Utils.getURLParamByName('user');

    this.mCurrentPhrase = 0; // TODO: get from URL.
    this.mRestTime = FTG.Utils.getURLParamByName('rest') || this.mRestTime;
    this.mDebug = FTG.Utils.getURLParamByName('debug') == 'true' || FTG.Utils.getURLParamByName('debug') == '1';
    this.mBipSound = document.getElementById('bip');
    this.mTanSound = document.getElementById('tan');
    this.mCalmSound = document.getElementById('calm');
    this.mFinished = false;

    this.mData = new FTG.Collector(this.mDebug);
    this.mRestTime *= 60 * 1000;

    console.log('[Experiment] Init with user uid:' + this.mUid + ', rest: ' + this.mRestTime + 'ms');

    if (this.mUid == null) {
        alert('User id not informed! Append ?user=DDD to the URL.');
    } else {
        this.greetings();
    }
};

FTG.Experiment.prototype.preventAbruptSessionEnd = function() {
    // Warn the user before leaving the page
    window.addEventListener("beforeunload", function(e) {
        var aMessage = 'You did something that will stop the study before it is over. Please, click "Stay on this Page" to resume your study.';

        e.preventDefault();
        e.returnValue = aMessage;

        return aMessage;
    });

    // Disable mouse right-click (prevent problems during the experiment)
    document.addEventListener('contextmenu', function(theEvent) {
        theEvent.preventDefault();
        return false;
    }, false);

    var aSelf = this;

    $(document).ready(function() {
        $(document).on("keydown", FTG.Utils.preventProblematicKeyboardKey);
    });
};

FTG.Experiment.prototype.enableCalmMusic = function(theStatus) {
    if (theStatus) {
        this.mCalmSound.loop = true;
        this.mCalmSound.currentTime = 0;
        this.mCalmSound.play();
    } else {
        this.mCalmSound.pause();
    }
};

FTG.Experiment.prototype.playBipSound = function() {
    this.mBipSound.currentTime = 0;
    this.mBipSound.play();
};

FTG.Experiment.prototype.playTanSound = function() {
    this.mTanSound.currentTime = 0;
    this.mTanSound.play();
};

FTG.Experiment.prototype.greetings = function() {
    var aSelf = this;

    $('#info').html(
        '<div class="greetings">' +
        '<h1>Instruções</h1>' +
        '<p>User: ' + this.mUid + '</p>' +
        '<p>Bem-vindo! Por favor espere até que o pesquisador permita que você comece.<br/>Quando for lhe dito, clique em "Iniciar".<br /><br />Obrigado por fazer parte desta pesquisa!</p>' +
        '<button id="start">Iniciar</button>' +
        '</div>'
    );

    $('#start').click(function() {
        aSelf.start();
    });

    $('#heart').click(function() {
        aSelf.mData.logMilestone(aSelf.mUid, -1, 'experiment_hr_start');
        aSelf.playBipSound();
        $(this).hide();

        // try to protect the experiment against unintended user actions
        // that will terminate the experiment, e.g. page refresh
        aSelf.preventAbruptSessionEnd();
    });

    // Play the bip sound to indicate everything is set.
    this.playBipSound();
};

FTG.Experiment.prototype.generateGameURL = function(theGameInfo) {
    var aGameParams = '';

    if (theGameInfo.params) {
        for (var aParam in theGameInfo.params) {
            aGameParams += '&' + aParam + '=' + encodeURIComponent(theGameInfo.params[aParam]);
        }
    }

    return theGameInfo.url + '?user=' + this.mUid + '&game=' + theGameInfo.id + '&rand=' + Math.random() + '&debug=' + this.mDebug + aGameParams;
};

FTG.Experiment.prototype.startExperiment = function(phrases) {
    var aSelf = this;
    var iniTime = 0,
        endTime = 0
    var recordText = 'Gravar';

    if (aSelf.mCurrentPhrase < phrases.length) {

        $('#info').html('<h4>' + phrases[aSelf.mCurrentPhrase] + '</h4>' +
            '<button id="next">Proximo</button> <button id="record">Gravar</button>'
        ).show();

        $('#next').click(function() {
            aSelf.mCurrentPhrase += 1
            aSelf.startExperiment(phrases)
        });

        $('#record').click(function() {
            $('#text').html(recordText)
            if (iniTime == 0) {
                iniTime = (new Date).getTime() / 1000
                document.getElementById("record").textContent = 'Parar'
            } else {
                endTime = (new Date).getTime() / 1000
                aSelf.saveTimeStamp(iniTime - aSelf.mStarTime, endTime - aSelf.mStarTime);
                iniTime = endTime = 0;
                document.getElementById("record").textContent = 'Gravar'
            }

        });

    } else {
        this.finish()
    }
}

FTG.Experiment.prototype.start = function() {
    $('#info').html(
        '<div class="questionnaire">' +
        '<h2>Questions</h2>' +
        '<p>Please tell us a bit about you.</p>' +
        '<div id="questions" class="questions"></div>' +
        '</div>'
    );

    aQuestions = new FTG.Questionnaire(
        'questions',
        this.mUid, -1, // no game
        FTG.Questions.User,
        this.concludeCurrentQuestionnaire,
        this
    );

};

FTG.Experiment.prototype.proceedAfterQuestionnaireAnswered = function() {
    var text;
    var aSelf = this

    FTG.Utils.readTextFile('../backend/phrases.txt', function(res) {
        text = res.split(/\r?\n/)
    })
    this.mStarTime = (new Date).getTime() / 1000 + this.delayTimeAudacity
    $.ajax({
        url: '../backend/startRecording.php',
        method: 'POST'
    }).done(function(theData) {
        console.error('Audacity should be running')
        aSelf.startExperiment(text)
    }).fail(function(theXHR, theText) {
        // TODO: show some user friendly messages?
        console.error('Something wrong: ' + theXHR.responseText, theXHR, theText);
    });

}

FTG.Experiment.prototype.concludeCurrentQuestionnaire = function(theGameId, theData) {
    var aSelf = this;

    // console.log('[Experiment] Sending questionnaire data (game: ' + theGameId + ')', JSON.stringify(theData));

    $.ajax({
        url: '../backend/',
        method: 'POST',
        data: {
            method: 'answer',
            user: this.mUid,
            data: JSON.stringify({ t: Date.now(), d: theData })
        },
        dataType: 'json'

    }).done(function(theData) {
        if (theData.success) {
            console.log('[Experiment] Questionnaire data has been saved!');
            aSelf.proceedAfterQuestionnaireAnswered();
        } else {
            console.error('[Experiment] Backend didn\'t like the answers: ' + theData.message);
        }
    }).fail(function(theXHR, theText) {
        // TODO: show some user friendly messages?
        console.error('Something wrong: ' + theXHR.responseText, theXHR, theText);
    });
};

FTG.Experiment.prototype.finish = function() {
    if (this.mFinished) {
        this.sendSubjectHome();
        return;
    }

    console.log('[Experiment] Finishing up. Last chance to ask anything.');
    this.playTanSound();
    this.mData.logMilestone(this.mUid, -1, 'experiment_final_questions_start');

    $('#info').html(
        '<div class="questionnaire">' +
        '<h2>Questions</h2>' +
        '<p>Please tell us a bit about you.</p>' +
        '<div id="questions" class="questions"></div>' +
        '</div>'
    );

    aQuestions = new FTG.Questionnaire(
        'questions',
        this.mUid, -1, // no game
        FTG.Questions.User,
        this.concludeCurrentQuestionnaire,
        this
    );

    this.mFinished = true;
};

FTG.Experiment.prototype.saveTimeStamp = function(timestampIni, timestampEnd) {
    var aSelf = this;

    console.log('[Experiment] Saving timestamp for user' + this.mUserId + ' and phrase ' + this.mCurrentPhrase + '.');

    $.ajax({
        url: '../backend/savetimestamp.php',
        method: 'POST',
        data: {
            method: 'saveTimeStamp',
            user: this.mUid,
            phraseid: this.mCurrentPhrase + 1,
            timestampIni: timestampIni,
            timestampEnd: timestampEnd,
        },
        dataType: 'json'

    }).done(function(theData) {
        if (theData.success) {
            console.log('[Experiment] Timestamp has been saved!');
        } else {
            console.error('[Experiment] Backend didn\'t like the answers: ' + theData.message);
        }
    }).fail(function(theXHR, theText) {
        // TODO: show some user friendly messages?
        console.error('Something wrong: ' + theXHR.responseText, theXHR, theText);
    });
};

// Start the party!
$(function() {
    FTG.Experiment.instance = new FTG.Experiment();
});