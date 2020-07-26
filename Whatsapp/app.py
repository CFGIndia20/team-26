from flask import Flask, request
import requests
from twilio.twiml.messaging_response import MessagingResponse
from twilio.rest import Client
import json
app = Flask(__name__)

@app.route("/")
def hello():
    return "Hello, Neha!"

@app.route("/sms", methods=['POST','GET'])
def sms_reply():
    print("Hello")
    """Respond to incoming calls with a simple text message."""
    # Fetch the message
    msg = request.form.get('Body')

    # Create reply
    resp = MessagingResponse()
    
    greetMsg = '''Hello, How can I help you today?\n\n
1. Send me a report\n 
2. How was my contribution utilized?\n
3. For what cause can I contribute?\n
4. What is the current strenght of paitnets.\n\n
Please reply with the sr. number of your question.'''

    flag = 2

    msg = msg.lower()
    if msg == 'hey' or msg == 'hello' or ('hi' in msg):
        resp.message('Hello, please reply with your 10 digit mobile number for verification.')
       
        #Send number recive 0 if not verified 1 if verified
    elif msg == '9876543210': #user number
        flag = 1
        resp.message(greetMsg)
    elif len(msg) == 10 and msg != '9876543210':
        resp.message("Sorry, this account is not verified as a donar.")
    elif msg == '1':
        #insert report API
        res = requests.get('http://localhost:8000/api/report/insights')
        dictdata = json.loads(res.text)
        report = dictdata['data'][0]['top_3_donation']
        s = ''
        for i in report:
            for k,v in i.items():
                s += str(k)+" : "+str(v)+"\n"
                print(k,v)
        
        #Try media upload 
        resp.message(s)
       

    elif msg == '2':
        #insert utilized API
        #r = requests.get(url = URL, params = 'utilized')
        #data = r.json() #might be a dict
        resp.message("Your donation was utilized for arranging some educational events for the children.")
    elif msg == '3':
        #r = requests.get(url = URL, params = 'how can contribution')
        #data = r.json() #might be a dict
        resp.message("You can send in money or other items like food, stationary, books etc. You can call on our help line to get more details.")
    elif msg == '4':
        #r = requests.get(url = URL, params = 'strenght')
        #data = r.json() #might be a dict
        res = requests.get('http://localhost:8000/api/patient/strength')
        dictdata = json.loads(res.text)
        resp.message("Total number of paitents currently are "+str(dictdata['data']))
    
    else:
        resp.message("Sorry, I could not understand.")
        #resp.message("Failed")
    return str(resp)

if __name__ == "__main__":
    app.run(debug=True)


    