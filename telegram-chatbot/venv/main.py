#!/usr/bin/python
# -*- coding: utf-8 -*-
# Telegram chatbot connects with the user and asks it for his phone number and verifies its status.
# Donor can acccess its report and add some more points too.

# importing modules of python in django

from pip._vendor import requests
import random
import mysql.connector
import time

# url of telegram chatbot

url = 'https://api.telegram.org/bot<token>'


# create func that get chat id

def get_chat_id(update):
    chat_id = update['message']['chat']['id']
    return chat_id


# create function that get message text

def get_message_text(update):
    message_text = update['message']['text']
    return str(message_text)


# create function that get last_update

def last_update(req):
    response = requests.get(req + 'getUpdates')
    response = response.json()
    result = response['result']
    total_updates = len(result) - 1
    return result[total_updates]  # get last record message update


# create function that let bot send message to user

def send_message(chat_id, message_text):
    params = {'chat_id': chat_id, 'text': message_text}
    response = requests.post(url + 'sendMessage', data=params)
    return response


# create main function for navigate or reply message back

def main():
    update_id = last_update(url)['update_id']
    while True:
        update = last_update(url)
        if update_id == update['update_id']:

            if get_message_text(update).lower() == 'hi' \
                or get_message_text(update).lower() == 'hello':
                send_message(get_chat_id(update),
                             'Welcome to St Jude Donar Chatbot. Please enter your Phone number'
                             )

                # print("sending contact details to databse for reports")

                send_message(get_chat_id(update),
                             '''Select the options from following : 
 1. Sending the report 
 2. 2. How was my contribution utilized?.
 3. How can I contribute?  
 4. How many patients are benefited ? ''')
            elif get_message_text(update) == '7889455612':

                                                             # Sample Phone Number
                # print("sending contact details to databse for reports")
                # requests.get(url, params={status: verified or not?})

                flag = 1
                send_message(get_chat_id(update),
                             'We will send a report to you.')
            elif len(get_message_text(update)) == 10 and msg \
                != '7889455612':

                resp.message('Sorry, this account is not verified as a donar.'
                             )
            elif get_message_text(update) == '1':

                # x = requests.post(url, data)
                # data = x.json() #might be a dict

                send_message(get_chat_id(update), 'Sending the report')
            elif get_message_text(update) == '2':

                # requests.get(url, params={report:text})

                send_message(get_chat_id(update),
                             'Your Donation was utilized for so and so purpose.'
                             )
            elif get_message_text(update) == '3':

                # requests.post(url, data={donation: money?clothes?both})

                send_message(get_chat_id(update),
                             'You can send in money and clothes.')
            elif get_message_text(update) == '4':

                # requests.get(url, params={strength:table_count})

                send_message(get_chat_id(update),
                             'Current Strength is 100')
            else:

                send_message(get_chat_id(update),
                             'Sorry couldnt understand.')

            update_id += 1  # to update ids i.e move to the next one


# call the function to make it reply

main()
