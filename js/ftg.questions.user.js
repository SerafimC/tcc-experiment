/**
 * A a few question for each user of the experiment.
 */

var FTG = FTG || {};

FTG.Questions = FTG.Questions || {};

FTG.Questions.User = [{
        text: 'Qual a sua idade? (responda em anos)',
        input: true,
    },
    {
        text: 'Qual a sua altura? (responda em centimetros)',
        input: true,
    },
    {
        text: 'Qual o seu peso? (responda em kilos)',
        input: true,
    },
    {
        text: 'Qual o seu genero?',
        hide: true,
        options: [
            { value: 1, label: 'Masculino' },
            { value: 2, label: 'Feminino' },
            { value: 3, label: 'Outro' }
        ]
    },
    {
        text: 'Qual a sua etnia?',
        hide: true,
        options: [
            { value: 1, label: 'Branca' },
            { value: 2, label: 'Negra' },
            { value: 3, label: 'Indigena' },
            { value: 4, label: 'Pardo' },
            { value: 5, label: 'Amarela' },
            { value: 6, label: 'Outra' }
        ]
    }
];