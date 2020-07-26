# Telegram chatbot connects with the user and asks it for his phone number and verifies its status.
# Donor can access its report and add some more points too.


#importing modules of python in django
from pip. _vendor import requests
import random
import mysql.connector
import  time


# url of telegram chatbot
url = "https://api.telegram.org/bot1187551081:AAGEtwpV2v0PhZgBEaMrGLbcGLlzT09o2YM/"


# create func that get chat id
def get_chat_id(update):
    chat_id=update['message']["chat"]["id"]
    return chat_id


# create function that get message text
def get_message_text(update):
    message_text = update['message']["text"]
    return str(message_text)


# create function that get last_update
def last_update(req):
    response = requests.get(req + "getUpdates")
    response = response.json()
    result = response["result"]
    total_updates = len(result) -1
    return result[total_updates]  # get last record message update


# create function that let bot send message to user
def send_message(chat_id, message_text):
    params = {"chat_id": chat_id, "text": message_text}
    response = requests.post(url + "sendMessage", data=params)
    return response


#database connection
import mysql.connector

mydb = mysql.connector.connect(
  host="localhost",
  user="root",
  password="",
    database="donar"
)


# create main function for navigate or reply message back
def main():
    update_id = last_update(url)["update_id"]
    while True:
        update = last_update(url)
        if update_id == update["update_id"]:

            if get_message_text(update).lower() == "hi" or get_message_text(update).lower() == "hello":
                send_message(get_chat_id(update), "Welcome to St Jude Donor's Chatbot. Please enter your Phone number and then select the options.")
                #print("sending contact details to databse for reports")
                send_message(get_chat_id(update),
                             'Select the options from following : \n 1. Want to see my report \n 2. How was my contribution utilized?.'
                             '\n 3. How can I contribute?  \n 4. How many patients are benefited ? ')


            elif (get_message_text(update)) == '7889455612': #Sample Phone Number
                #-------------- For REST API --------------------------- #
                #print("sending contact details to databse for reports")
                #requests.get(url, params={status: verified or not?})
                #flag=1
                # -------------- For REST API --------------------------- #

                # ------------------ For MYSQL Database without REST API ----------- #
                mycursor = mydb.cursor()
                mycursor.execute("SELECT Approval FROM Donor")
                myresult = mycursor.fetchall()
                send_message(get_chat_id(update), "Your Approval state is:")
                send_message(get_chat_id(update), myresult)

                # ------------------ For MYSQL Database without REST API ----------- #


            elif len(get_message_text(update)) == 10 and msg != '7889455612':
                resp.message("Sorry, this account is not verified as a donar.")


            elif get_message_text(update) == "1":
                # -------------- For REST API --------------------------- #
                #x = requests.post(url, data)
                #data = x.json() #might be a dict
                # -------------- For REST API --------------------------- #

                # ------------------ For MYSQL Database without REST API ----------- #
                send_message(get_chat_id(update), 'Sending the report')
                mycursor = mydb.cursor()
                mycursor.execute("SELECT Report FROM Donor")
                myresult = mycursor.fetchall()
                send_message(get_chat_id(update), myresult)

                # ------------------ For MYSQL Database without REST API ----------- #


            elif get_message_text(update) == "2":
                send_message(get_chat_id(update), 'Your Donation was utilized for so and so purpose.')


            elif get_message_text(update)== "3":
                send_message(get_chat_id(update), 'You can send in money and clothes.')


            elif get_message_text(update) == '4':
                # -------------- For REST API --------------------------- #
                #requests.get(url, params={strength:table_count})
                # -------------- For REST API --------------------------- #

                # ------------------ For MYSQL Database without REST API ----------- #
                mycursor = mydb.cursor()
                mycursor.execute("SELECT  beneficiary FROM Donor")
                myresult = mycursor.fetchall()
                send_message(get_chat_id(update), "No. of beneficiary: ")
                send_message(get_chat_id(update), myresult)
                # ------------------ For MYSQL Database without REST API ----------- #

            else:
                send_message(get_chat_id(update), 'Sorry couldnt understand.')

            update_id += 1 # to update ids i.e move to the next one


# call the function to make it reply
main()
















