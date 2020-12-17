import subprocess
import os
import hern
import HernTool.main as tool
from getpass import getpass

class GodMode:
    def __init__(self, command):
        self.command = command
        # self.state = True
        command = command.lower()
        self.commands = ['help', 'del', 'show', 'add', 'get']
        
        data = hern.showall('data')
        self.custom_commands = []

        if not self.validate(command):
            self.executer(command)
        else:
            print(self.validate(command))

    def validate(self, command):
        if command.split()[0] in self.commands or command.split()[0] in self.custom_commands:
            return ''
        else:
            return 'Invalid command.'
        
    def executer(self, command):
        command = command.split()

        if command[0] == self.commands[0]:
            os.system("clear")
            print('     ___   ___                          ___________                  ___')
            print('    /  /  /  /                         /___   ____/                 /  /')
            print('   /  /__/  / _______  __  ___  __ _____  /  / ________  ________  /  /')
            print('  /   __   / /  __  / / /.\" _/ / /\"    / /  / /  __   / /  __   / /  /')
            print(' /  /  /  / /  ____/ /  .\'\"   / /     / /  / /  /_/  / /  /_/  / /  /')
            print('/__/  /__/ /______/ /__/     /____/__/ /__/ /_______/ /_______/ /__/')
            print()
            print('\u001b[01mDeveloped by: \u001b[00m\u001b[03mHernie Jabien\u001b[00m')
            print('\u001b[01mVersion: \u001b[00m\u001b[03m0.7\u001b[00m')
            print('_'*70)
            print('\nHELP YOUR SELF.')
        elif command[0] == self.commands[3]:
            state = True
            usr = input('Username/Email: ')
            while state:
                pwd = getpass('Password: ')
                pwd1 = getpass('Re-type password: ')
                if pwd == pwd1:
                    state = False
                else:
                    print('Password didn\'t match.')
            hern.insertdata('data',{'type':command[1], 'user':usr, 'pwd':pwd})
        elif command[0] == self.commands[2]:
            data = hern.showall('data')
            if len(command) == 2 and command[1] != 'key':
                temp = [['NO.','USERNAME/EMAIL']]            
            else:
                temp = [['NO.','TYPE','USERNAME/EMAIL']]
            print()
            for count,x in enumerate(data,start=1):
                if len(command) == 2 and command[1] == 'key':
                    if count == int(command[2]):
                        temp.append([str(count),x['type'],x['user']])
                elif len(command) == 2:
                    if x['type'] == command[1]:
                        temp.append([str(count),x['user']])
                else:
                    temp.append([str(count),x['type'],x['user']])
            # print(temp)
            for x in tool.strmod().listTable(temp, 10):
                temp1 = ''
                for y in x:
                    temp1 += y
                print(temp1)
            print()
        elif command[0] == self.commands[1]:
            data = hern.showall('data')
            if len(command) == 2:
                # print('eyy')
                for count,x in enumerate(data,start=1):
                    if count == int(command[1]):
                        hern.deletedata('data',{'type':x['type'],'user':x['user']})
        elif command[0] == self.commands[-1]:
            data = hern.showall('data')
            try:
                for count,x in enumerate(data,start=1):
                    if command[1] == 'key':
                        if count == int(command[2]):
                            print('pass_key>> '+x['pwd'])
            except IndexError:
                print('Syntax >> get key data_no')
        else:
            pass
            

                

def main():
    # print(len([1,2,3]))
    hern.createdb('safhern')
    hern.createtb('data',['type','user','pwd'])
    hern.createtb('sudo',['user','pwd'])
    pwd = ''
    state = True
    while state:
        if hern.showall('sudo'):
            if pwd == '':
                pwd = getpass("Passphrase: ")
            if pwd == hern.showall('su')[0]['pwd']:
                GodMode(input("Command [\'"+ hern.showall('sudo')[0]['user'] +"\']: "))
            else:
                pwd = ''
                print("Unauthorized access.")
        else:
            usr = input("Username: ")
            pwd1 = getpass("New sudo password: ")
            hern.insertdata('sudo',{'user':usr,'pwd':pwd1})
    

if __name__ == "__main__":
    main()