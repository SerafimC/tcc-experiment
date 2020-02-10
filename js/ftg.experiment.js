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
    var topText = '<p style="font-size: 25px; margin-left:10px;"> Clique em <b>INICIAR</b> para gravar e logo após leia em voz alta a frase abaixo </p> ' +
    '<p style="font-size: 25px; margin-left:10px;"> Quando terminar a leitura em voz alta, clique em <b>PARAR</b> para encerrar a gravação. </p> '
    var bottomText = '<p style="font-size: 25px; margin-left:10px;"> Acredita que a gravação ficou como o esperado? </p>' +
        '<p style="font-size: 20px; margin-left:25px; ">Se sim, clique em <b>CONTINUAR</b>.</p>' +
        '<p style="font-size: 20px; margin-left:25px;">Se não, clique em <b>REGRAVAR</b> e, quando pronto, em <b>INICIAR</b> novamente.</p>'

    var startButton = '<button id="record" style="background-color:#FF0000;">Iniciar</button>'
    var stopButton = '<button id="stop" style="background-color:#FFCCCB; margin-left:50px;" disable>Parar</button>'

    var repeatButton = '<button id="repeat" style="background-color:#8ABAAE; margin-left:50px;" disable>Regravar</button>'
    var nextButton = '<button id="next" style="background-color:#9CCC9C; margin-left:50px;" disable>Continuar</button>'

    if (aSelf.mCurrentPhrase < phrases.length) {
        var phraseToberead = '<p>' + phrases[aSelf.mCurrentPhrase] + '</p>'

        $('#info').html(topText + '<br><div style="background-color:#F5F5F5; width:600px;margin-left:50px;padding:20px;padding-left:50px;box-shadow: 5px 10px #888888;"><h4>' + phraseToberead + '</h4><br>' + startButton + stopButton + "</div>" 
        + '<br><br>' + bottomText + repeatButton + nextButton).show();

        document.getElementById("stop").disabled = true;
        document.getElementById("repeat").disabled = true;
        document.getElementById("next").disabled = true;

        $('#next').click(function() {
            aSelf.mCurrentPhrase += 1
            aSelf.startExperiment(phrases)
        });

        $('#record').click(function() {
            iniTime = (new Date).getTime() / 1000
            document.getElementById("record").disabled = true
            document.getElementById("record").style.background = '#FFCCCB'
            document.getElementById("stop").style.background = '#FF0000'
            document.getElementById("stop").disabled = false

        });

        $('#stop').click(function() {
            endTime = (new Date).getTime() / 1000
            aSelf.saveTimeStamp(iniTime - aSelf.mStarTime, endTime - aSelf.mStarTime);
            iniTime = endTime = 0;
            document.getElementById("stop").disabled = true
            document.getElementById("stop").style.background = '#FFCCCB'
            document.getElementById("next").style.background = '#149414'
            document.getElementById("next").disabled = false
            document.getElementById("repeat").style.background = '#2E856E'
            document.getElementById("repeat").disabled = false
        });

        $('#repeat').click(function() {
            endTime = (new Date).getTime() / 1000
            aSelf.saveTimeStamp(iniTime - aSelf.mStarTime, endTime - aSelf.mStarTime);
            iniTime = endTime = 0;
            document.getElementById("next").style.background = '#9CCC9C'
            document.getElementById("next").disabled = true
            document.getElementById("repeat").style.background = '#8ABAAE'
            document.getElementById("repeat").disabled = true
            document.getElementById("record").disabled = false
            document.getElementById("record").style.background = '#FF0000'
        });

    } else {
        this.finish()
    }
}

FTG.Experiment.prototype.start = function() {
    $('#info').html(
        '<div class="questionnaire">' +
        '<h2>Questionário</h2>' +
        '<p>Por favor, nos conte mais sobre você.</p>' +
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

FTG.Experiment.prototype.instructions1 = function() {
    var aSelf = this;

    $('#info').html(
        '<br>' +
        '<p style="margin:25px;"> Você está prestes a iniciar um experimento para capturar diferentes amostras da sua voz. </p>' +
        '<p style="margin:25px;"> Você deverá ler um total de 200 frases diferentes. Durante a leitura, mantenha a calma e tente ler da forma mais correta e natural possível. </p>' +
        '<p style="margin:25px;"> Na tela seguinte serão apresentadas instruções de como utilizar o programa de gravação. Antes de iniciar, tire suas dúvidas com o instrutor </p>' +
        '<div style="text-align: center;"><button id="continue">Entendi</button></div>'
    ).show();

    $('#continue').click(function() {
        aSelf.instructions2();
    });
}

FTG.Experiment.prototype.instructions2 = function() {
    var aSelf = this;
    
    $('#info').html(
        '<br><div style="text-align: center;"><img src="../img/instrucoes.png" width="90%"></div>' +
        '<div style="text-align: center;"><button id="continue" style="width:500px;">Estou pronto para começar!</button></div>'
    ).show();

    $('#continue').click(function() {
        aSelf.startRecording();
    });
}

FTG.Experiment.prototype.startRecording = function() {
    var text;
    var aSelf = this

    FTG.Utils.readTextFile('../backend/phrases.txt', function(res) {
        text = res.split(/\r?\n/)
    })
    aSelf.playBipSound();
    this.mStarTime = (new Date).getTime() / 1000
    aSelf.startExperiment(text)
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
            aSelf.instructions1();
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