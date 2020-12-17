#Translator
def encode(stR):
	stR = stR.lower()
	res = []
	msg = ""
	for i in range(len(stR)):
		if stR[i] == "a":
			res.append("001000")
		elif stR[i] == "e":
			res.append("001001")
		elif stR[i] == "i":
			res.append("001010")
		elif stR[i] == "o":
			res.append("001011")
		elif stR[i] == "u":
			res.append("001100")
		elif stR[i] == "b":
			res.append("001101")
		elif stR[i] == "c":
			res.append("001110")
		elif stR[i] == "d":
			res.append("001111")
		elif stR[i] == "f":
			res.append("010000")
		elif stR[i] == "g":
			res.append("010001")
		elif stR[i] == "h":
			res.append("010010")
		elif stR[i] == "j":
			res.append("010011")
		elif stR[i] == "k":
			res.append("010100")
		elif stR[i] == "l":
			res.append("010101")
		elif stR[i] == "m":
			res.append("010110")
		elif stR[i] == "n":
			res.append("010111")
		elif stR[i] == "p":
			res.append("011000")
		elif stR[i] == "q":
			res.append("011001")
		elif stR[i] == "r":
			res.append("011010")
		elif stR[i] == "s":
			res.append("011011")
		elif stR[i] == "t":
			res.append("011111")
		elif stR[i] == "v":
			res.append("000100")
		elif stR[i] == "w":
			res.append("000101")
		elif stR[i] == "x":
			res.append("000110")
		elif stR[i] == "y":
			res.append("000111")
		elif stR[i] == "z":
			res.append("000001")
		elif stR[i] == "A":
			res.append("101000")
		elif stR[i] == "E":
			res.append("101001")
		elif stR[i] == "I":
			res.append("101010")
		elif stR[i] == "O":
			res.append("101011")
		elif stR[i] == "U":
			res.append("101100")
		elif stR[i] == "B":
			res.append("101101")
		elif stR[i] == "C":
			res.append("101110")
		elif stR[i] == "D":
			res.append("101111")
		elif stR[i] == "F":
			res.append("110000")
		elif stR[i] == "G":
			res.append("110001")
		elif stR[i] == "H":
			res.append("110010")
		elif stR[i] == "J":
			res.append("110011")
		elif stR[i] == "K":
			res.append("110100")
		elif stR[i] == "L":
			res.append("110101")
		elif stR[i] == "M":
			res.append("110110")
		elif stR[i] == "N":
			res.append("110111")
		elif stR[i] == "P":
			res.append("111000")
		elif stR[i] == "Q":
			res.append("111001")
		elif stR[i] == "R":
			res.append("111010")
		elif stR[i] == "S":
			res.append("111011")
		elif stR[i] == "T":
			res.append("111111")
		elif stR[i] == "V":
			res.append("100100")
		elif stR[i] == "W":
			res.append("100101")
		elif stR[i] == "X":
			res.append("100110")
		elif stR[i] == "Y":
			res.append("100111")
		elif stR[i] == "Z":
			res.append("100001")
		elif stR[i] == " ":
			res.append("2")
		elif stR[i] == ".":
			res.append("3")
		elif stR[i] == "!":
			res.append("4")
		elif stR[i] == "[":
			res.append("5")
		elif stR[i] == "]":
			res.append("6")
	for i in res:
		msg += i
	return msg
def decode(stR):
	state = True
	p = 0
	res = []
	msg = ""
	for i in range(len(stR)):
		if stR[i] not in "0123456":
			return False
	while state:
		if stR[p] in "23456":
			if stR[p] == "2":
				res.append(" ")
			elif stR[p] == "3":
				res.append(".")
			elif stR[p] == "4":
				res.append("!")
			elif stR[p] == "5":
				res.append("[")
			elif stR[p] == "6":
				res.append("]")
			p += 1
		else:
			if stR[p:p+6] == "001000":
				res.append("a")
			elif stR[p:p+6] == "001001":
				res.append("e")
			elif stR[p:p+6] == "001010":
				res.append("i")
			elif stR[p:p+6] == "001011":
				res.append("o")
			elif stR[p:p+6] == "001100":
				res.append("u")
			elif stR[p:p+6] == "001101":
				res.append("b")
			elif stR[p:p+6] == "001110":
				res.append("c")
			elif stR[p:p+6] == "001111":
				res.append("d")
			elif stR[p:p+6] == "010000":
				res.append("f")
			elif stR[p:p+6] == "010001":
				res.append("g")
			elif stR[p:p+6] == "010010":
				res.append("h")
			elif stR[p:p+6] == "010011":
				res.append("j")
			elif stR[p:p+6] == "010100":
				res.append("k")
			elif stR[p:p+6] == "010101":
				res.append("l")
			elif stR[p:p+6] == "010110":
				res.append("m")
			elif stR[p:p+6] == "010111":
				res.append("n")
			elif stR[p:p+6] == "011000":
				res.append("p")
			elif stR[p:p+6] == "011001":
				res.append("q")
			elif stR[p:p+6] == "011010":
				res.append("r")
			elif stR[p:p+6] == "011011":
				res.append("s")
			elif stR[p:p+6] == "011111":
				res.append("t")
			elif stR[p:p+6] == "000100":
				res.append("v")
			elif stR[p:p+6] == "000101":
				res.append("w")
			elif stR[p:p+6] == "000110":
				res.append("x")
			elif stR[p:p+6] == "000111":
				res.append("y")
			elif stR[p:p+6] == "000001":
				res.append("z")
			elif stR[p:p+6] == "101000":
				res.append("A")
			elif stR[p:p+6] == "101001":
				res.append("E")
			elif stR[p:p+6] == "101010":
				res.append("I")
			elif stR[p:p+6] == "101011":
				res.append("O")
			elif stR[p:p+6] == "101100":
				res.append("U")
			elif stR[p:p+6] == "101101":
				res.append("B")
			elif stR[p:p+6] == "101110":
				res.append("C")
			elif stR[p:p+6] == "101111":
				res.append("D")
			elif stR[p:p+6] == "110000":
				res.append("F")
			elif stR[p:p+6] == "110001":
				res.append("G")
			elif stR[p:p+6] == "110010":
				res.append("H")
			elif stR[p:p+6] == "110011":
				res.append("J")
			elif stR[p:p+6] == "110100":
				res.append("K")
			elif stR[p:p+6] == "110101":
				res.append("L")
			elif stR[p:p+6] == "110110":
				res.append("M")
			elif stR[p:p+6] == "110111":
				res.append("N")
			elif stR[p:p+6] == "111000":
				res.append("P")
			elif stR[p:p+6] == "111001":
				res.append("Q")
			elif stR[p:p+6] == "111010":
				res.append("R")
			elif stR[p:p+6] == "111011":
				res.append("S")
			elif stR[p:p+6] == "111111":
				res.append("T")
			elif stR[p:p+6] == "100100":
				res.append("V")
			elif stR[p:p+6] == "100101":
				res.append("W")
			elif stR[p:p+6] == "100110":
				res.append("X")
			elif stR[p:p+6] == "100111":
				res.append("Y")
			elif stR[p:p+6] == "100001":
				res.append("Z")
			p += 6
		if p == len(stR):
			state = False
	for i in res:
		msg += i
	return msg
