from flask import Flask, request
from twilio.twiml.messaging_response import MessagingResponse

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
    
    greetMsg = '''Hello, How can I help you today?\n\n1. Send me the report.\n 
2. How was my contribution utilized?.\n
3. How can I contribute? \n
4. What is the current strenght of paitnets.\n
5. ...\n
Please reply with the sr. number of your question.'''

    flag = 2

    msg = msg.lower()
    if msg == 'hey' or msg == 'hello' or ('hi' in msg):
        resp.message('Hello, please reply with your 10 digit mobile number for verification.')
        #r = requests.get(url = URL, params = verified?)
        #Send number recive 0 if not verified 1 if verified
    elif msg == '9876543210': #user number
        flag = 1
        resp.message(greetMsg)
    elif len(msg) == 10 and msg != '9876543210':
        resp.message("Sorry, this account is not verified as a donar.")
    elif msg == '1':
        #insert report API
        #r = requests.get(url = URL, params = 'report')
        #data = r.json() #might be a dict
        resp.message("Sending Report")
    elif msg == '2':
        #insert utilized API
        #r = requests.get(url = URL, params = 'utilized')
        #data = r.json() #might be a dict
        resp.message("Your donation was utilized for so and so purpose")
    elif msg == '3':
        #r = requests.get(url = URL, params = 'how can contribution')
        #data = r.json() #might be a dict
        resp.message("You can send in money or cloths or food ..")
    elif msg == '4':
        #r = requests.get(url = URL, params = 'strenght')
        #data = r.json() #might be a dict
        resp.message("Current Strength is 100")
    
    else:
        resp.message("Sorry, I could not understand.")
        #resp.message("Failed")
    return str(resp)

if __name__ == "__main__":
    app.run(debug=True)


    