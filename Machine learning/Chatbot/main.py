import random as rnd

data = {"intents": [
                {"tag": "greeting",
                 "patterns": ["Hi", "Hello"],
                 "responses": ["Hello!", "Hi there, how can I help you?"],
                },
                {"tag": "age",
                 "patterns": ["How old", "what is your age"],
                 "responses": ["I am 20 years old!", "20 years young!"],
                },
                {"tag": "name",
                 "patterns": ["what is your name", "what should I call you"],
                 "responses": ["You can call me Hernie", "I'm Hernie"],
                }
            ]
        }

while True:
    user_input = input("Input: ")
    data2 = {}
    response = ""
    response_tag = ""

    for intent in data['intents']: 
        for pattern in intent['patterns']:
            pattern = pattern.split()
            for word in pattern:
                if word.lower() in user_input.lower() and len(word) != 1:
                    if intent['tag'] in data2:
                        data2[intent['tag']] = data2[intent['tag']] + 1
                    else:
                        data2[intent['tag']] = 1
        
    max = 0
    for tag in data2:
        if data2[tag] > max:
            max = data2[tag]

    for intent in data['intents']:
        if intent['tag'] in data2 and data2[intent['tag']] == max:
            response = intent['responses'][rnd.randint(0, len(intent['responses'])-1)]
            break


    print(data2)
    print("bot: ",response)