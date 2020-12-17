import subprocess
import os
import hern
import HernTool.main as tool

class GodMode:
    def __init__(self, command):
        self.command = command
        command = command.lower()
        self.commands = ['help', 'del', 'show', 'add']
        data = hern.showall('data')
        self.custom_commands = [x['project'] for x in data]


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
            # print('  -new\tCreates new project directory.')
        elif command[0] == self.commands[-1]:
            insertdata('data',{'project':command[1],'directory':command[2]})
        elif command[0] == self.commands[2]:
            data = hern.showall('data')
            temp = []
            for x in data:
                project = x['project']
                dirrectory = x['directory']
                temp.append([project,dirrectory])
            for x in tool.strmod().listTable(temp, 5):
                temp2 = ''
                for i in x:
                    temp2 += i
                print(temp2)
        elif command[0] == self.commands[1]:
            hern.deletedata('data',{'project':command[1]})
        else:
            command = self.command.split()
            # subprocess.call(['cd', hern.selectdata('data',{'project':command[0]})['directory'] + command[1]],shell=False)
            os.system('cd Web')
            os.system('ls')
            #  + hern.selectdata('data',{'project':command[0]})['directory'] + command[1] + '/'

                



# # subprocess.call(['echo','Helllo World'])
# print('Hello, ' + input())

def main():
    GodMode(input('Command: '))
    # pass

if __name__ == "__main__":
    main()