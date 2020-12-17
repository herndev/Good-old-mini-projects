from tkinter import *
import os

user = None
def Display(window):
    global user
    filel = open(user, "r")
    filel = filel.read().splitlines()
    mframe = Frame(window).place(x=0,y=0)
    infos = Label(mframe, text="ID number: %s\tEmployee Name: %s\nGender: %s\tAge: %s\nStatus: %s\tRate Per Hour: %s"%(filel[0],filel[1],filel[2],filel[3],filel[4],filel[5])).pack()
    
# Designing window for registration
 
def register():
    global register_screen
    register_screen = Toplevel(main_screen)
    register_screen.title("Register")
    register_screen.geometry("600x500")

    global idnumber
    global username
    global password
    global gender
    global age
    global status
    global rate
    global idnumber_entry
    global username_entry
    global password_entry
    global gender_entry
    global age_entry
    global status_entry
    global rate_entry
    idnumber = StringVar()
    username = StringVar()
    password = StringVar()
    gender = StringVar()
    age = StringVar()
    status = StringVar()
    rate = StringVar()
 
    Label(register_screen, text="Please enter details below", bg="blue").pack()
    Label(register_screen, text="").pack()
    idnumber_lable = Label(register_screen, text="Employee's I.D Number * ")
    idnumber_lable.pack()
    idnumber_entry = Entry(register_screen, textvariable=idnumber)
    idnumber_entry.pack()
    username_lable = Label(register_screen, text="Employee's Name * ")
    username_lable.pack()
    username_entry = Entry(register_screen, textvariable=username)
    username_entry.pack()
    idnumber_lable = Label(register_screen, text="Employee's Gender * ")
    idnumber_lable.pack()
    gender_entry = Entry(register_screen, textvariable=gender)
    gender_entry.pack()
    idnumber_lable = Label(register_screen, text="Employee's Age * ")
    idnumber_lable.pack()
    age_entry = Entry(register_screen, textvariable=age)
    age_entry.pack()
    idnumber_lable = Label(register_screen, text="Employee's Status * ")
    idnumber_lable.pack()
    status_entry = Entry(register_screen, textvariable=status)
    status_entry.pack()
    idnumber_lable = Label(register_screen, text="Employee's Rate Per Hour * ")
    idnumber_lable.pack()
    rate_entry = Entry(register_screen, textvariable=rate)
    rate_entry.pack()
    password_lable = Label(register_screen, text="Password * ")
    password_lable.pack()
    password_entry = Entry(register_screen, textvariable=password, show='*')
    password_entry.pack()
    Label(register_screen, text="").pack()
    Button(register_screen, text="Register", width=10, height=1, bg="blue", command = register_user).pack()
 
 
# Designing window for login 
 
def login():
    global login_screen
    login_screen = Toplevel(main_screen)
    login_screen.title("Login")
    login_screen.geometry("600x500")
    Label(login_screen, text="Please enter details below to login").pack()
    Label(login_screen, text="").pack()
 
    global idnumber_verify
    global password_verify
 
    idnumber_verify = StringVar()
    password_verify = StringVar()
 
    global idnumber_login_entry
    global password_login_entry
 
    Label(login_screen, text="Employee's I.D Number* ").pack()
    idnumber_login_entry = Entry(login_screen, textvariable=idnumber_verify)
    idnumber_login_entry.pack()
    Label(login_screen, text="").pack()
    Label(login_screen, text="Password * ").pack()
    password_login_entry = Entry(login_screen, textvariable=password_verify, show= '*')
    password_login_entry.pack()
    Label(login_screen, text="").pack()
    Button(login_screen, text="Login", width=10, height=1, command = login_verify).pack()
 
# Implementing event on register button
 
def register_user():
    idnumber_info = idnumber.get()
    password_info = password.get()
    name_info = username.get()
    gender_info = gender.get()
    age_info = age.get()
    status_info = status.get()
    rate_info = rate.get()
 
    file = open(idnumber_info, "w")
    file.write(idnumber_info + "\n")
    file.write(name_info + "\n")
    file.write(gender_info + "\n")
    file.write(age_info + "\n")
    file.write(status_info + "\n")
    file.write(rate_info + "\n")
    file.write(password_info)
    file.close()

    idnumber_entry.delete(0, END)
    username_entry.delete(0, END)
    password_entry.delete(0, END)
    gender_entry.delete(0, END)
    age_entry.delete(0, END)
    status_entry.delete(0, END)
    rate_entry.delete(0, END)
 
    Label(register_screen, text="Registration Success", fg="green", font=("calibri", 11)).pack()
 
# Implementing event on login button 
 
def login_verify():
    global user
    idnumber1 = idnumber_verify.get()
    password1 = password_verify.get()
    idnumber_login_entry.delete(0, END)
    password_login_entry.delete(0, END)
    user = idnumber1
    list_of_files = os.listdir()
    if idnumber1 in list_of_files:
        file1 = open(idnumber1, "r")
        verify = file1.read().splitlines()
        if password1 == verify[-1]:
            delete_login_success()
 
        else:
            password_not_recognised()
 
    else:
        user_not_found()
#Application

def app():
    global app_screen
    app_screen = Toplevel(main_screen)
    app_screen.geometry('1000x500')
    app_screen.title("Welcome")
    computation = Button(app_screen, text='     Show      ',padx=10,relief=RAISED,bd=15, command=lambda:Display(app_screen))
    computation.place(x=200,y=10)
    show = Button(app_screen, text='Computations',padx=10,relief=RAISED,bd=15)
    show.place(x=400,y=10)
    quitbutton = Button(app_screen, text='      Quit       ',padx=10,relief=RAISED,bd=15)
    quitbutton.place(x=600,y=10)

#Entry
def info():
    Label(username, text="Login Success")
    
# Designing popup for login success
 
def login_sucess():
    global login_success_screen
    login_success_screen = Toplevel(login_screen)
    login_success_screen.title("Success")
    login_success_screen.geometry("300x200")
    Label(login_success_screen, text="Login Success").pack()
    Button(login_success_screen, text="OK", command=delete_login_success).pack()
 
# Designing popup for login invalid password
 
def password_not_recognised():
    global password_not_recog_screen
    password_not_recog_screen = Toplevel(login_screen)
    password_not_recog_screen.title("Success")
    password_not_recog_screen.geometry("150x100")
    Label(password_not_recog_screen, text="Invalid Password ").pack()
    Button(password_not_recog_screen, text="OK", command=delete_password_not_recognised).pack()
 
# Designing popup for user not found
 
def user_not_found():
    global user_not_found_screen
    user_not_found_screen = Toplevel(login_screen)
    user_not_found_screen.title("Success")
    user_not_found_screen.geometry("150x100")
    Label(user_not_found_screen, text="User Not Found").pack()
    Button(user_not_found_screen, text="OK", command=delete_user_not_found_screen).pack()
 
# Deleting popups
 
def delete_login_success():
    login_screen.destroy()
    app()
 
def delete_password_not_recognised():
    password_not_recog_screen.destroy()
 
 
def delete_user_not_found_screen():
    user_not_found_screen.destroy()
 
 
# Designing Main(first) window
 
def main_account_screen():
    global main_screen
    main_screen = Tk()
    main_screen.geometry("600x500")
    main_screen.title("Account Login")
    Label(text="Select Your Choice", bg="blue", width="300", height="2", font=("Calibri", 13)).pack()
    Label(text="").pack()
    Button(text="Login", height="2", width="30", command = login).pack()
    Label(text="").pack()
    Button(text="Register", height="2", width="30", command=register).pack()
 
    main_screen.mainloop()
 
 
main_account_screen()
