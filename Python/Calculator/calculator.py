#PYTHON TKINTER CALCULATOR
#By: Hernie Jabien
#Copyright   2019 all rights reserved.

from hern import*
from tkinter import*
from tkinter import messagebox
from tkinter.ttk import Combobox

# Fonts
arialBold_lx = "Arial 30 bold"
arialBold_lg = "Arial 24 bold"
arialBold_sm = "Arial 14 bold"

#	Colors
blue = "#007bff"
indigo = "#6610f2"
purple = "#6f42c1"
pink = "#e83e8c"
red = "#dc3545"
orange = "#fd7e14"
yellow = "#ffc107"
green = "#28a745"
teal = "#20c997"
cyan = "#17a2b8"
white = "#fff"
gray = "#6c757d"
gray_dark = "#343a40"
primary = "#007bff"
secondary = "#6c757d"
success = "#28a745"
info = "#17a2b8"
warning = "#ffc107"
danger = "#dc3545"
light = "#f8f9fa"
dark = "#343a40"

# Main Frame Class
class MainView(Frame):
	# Define __ini__ function
	def __init__(self, *arg, **args):
		Frame.__init__(self, *arg, **args)

		# Calculator menus


		# Button labels
		buttons_label = [
			['C','Pi','E','/'],
			['1','2','3','*'],
			['4','5','6','-'],
			['7','8','9','+'],
			['?','0','=']
		]

		# Operation button colors
		button_colors = [ success, red, teal, yellow, primary ]

		headerFrame = Frame(self, bg=light, relief="ridge", bd=10)
		headerFrame.pack(side="top", fill="x")
		containerFrame = Frame(self, bg=white, bd=5)
		containerFrame.pack(side="top", fill="x", pady=5)

		topHeader = Frame(headerFrame, bg=light)
		topHeader.pack(side="top", fill="x")
		bottomHeader = Frame(headerFrame, bg=light)
		bottomHeader.pack(side="bottom", fill="x")

		formulaLabel = Label(topHeader, text="1+1", font=arialBold_sm, fg=gray, bg=light)
		formulaLabel.pack(side="right", fill="both", pady=2)

		resultLabel = Label(bottomHeader, text="2", font=arialBold_lx, fg=dark, bg=light)
		resultLabel.pack(side="right", fill="both", pady=2)

		rows = []
		columns = []

		# Display buttons
		for count, row in enumerate(buttons_label):	
			rows.append(Frame(containerFrame, bg=light))
			rows[count].pack(side="top", pady=3)
			for count2, column in enumerate(row):
				# If button is the last button from the right
				if column == row[-1]:
					btnBg = button_colors[count]
					btnFg = white
				else:
					btnBg = light
					btnFg = dark

				# If button is = button increase width
				if count == len(buttons_label)-1 and column == row[-1]:
					columns.append(
						Button(rows[count], text=column, font=arialBold_lg, width=9, height=2, bd=2, relief="raised", bg=btnBg, fg=btnFg, command=self.output)
						.pack(side="left", padx=6)
					)
				else:
					columns.append(
						Button(rows[count], text=column, font=arialBold_lg, width=3, height=2, bd=2, relief="raised", bg=btnBg, fg=btnFg, command=lambda:self.output(this))
						.pack(side="left", padx=6)
					)
				print(column)

				# button.bind('<Return>')
		print(columns)

	
	def output(self, value=''):
		if not value:
			print("Hello")
		else:
			print(value)
		
# If run directly using this file
if __name__ == "__main__":
	root = Tk()
	main = MainView(root, bg=white)
	main.pack(fill="both", expand=True)
	root.title("Calculator")
	root.wm_geometry("400x600")
	root.resizable(0,0)
	root.mainloop()