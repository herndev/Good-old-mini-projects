import tkinter as tk

class Snake(tk.Canvas):
    def __init__(self):
        super().__init__(width=600, height=600, background='black', highlightthickness=0)

        self.load_assets()

    def load_assets(self):
        

window = tk.Tk()
window.title('Snake')
window.resizable(False, False)

board = Snake()
board.pack()

window.mainloop()