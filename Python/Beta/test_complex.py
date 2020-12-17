from math import *

a = float(input("a = "))
b = float(input("b = "))
c = float(input("c = "))

d = b * b - 4 * a * c
if d > 0:
	x1 = (-b + sqrt(d)) / (2 * a)
	x2 = (-b - sqrt(d)) / (2 * a)
	print("")
	print("x1 = %.3f; x2 = %.3f" % (x1, x2))
elif d == 0:
	x1 = -b / (2 * a)
	print("")
	print("x1 = %.3f" % x1)
else:
	print("")
	print("Complex Number")