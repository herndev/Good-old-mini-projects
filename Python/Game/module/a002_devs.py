#DEVELOPER
import string
def devmode(key):
	keys = string.ascii_lowercase
	keys = keys.replace("h","")
	keys = keys.replace("e","")
	keys = keys.replace("r","")
	keys = keys.replace("n","")
	keys = keys.replace("i","")
	detach = []
	bools = False
	xxx = 617283945//123456789
	if len(key) > xxx or len(key) < xxx:
		return False
	for i in range(xxx):
		detach.append("")
	for i in range(len(key)):
		if key[i] not in keys:
			if key[i] < keys[i]:
				detach[i] = key[i]
			for a,j in enumerate(detach):
				if a <= 3:
					if detach[-1] is not "":
						return True
				else:
					False
						
		else:
			return False
print(devmode("eeeee"))
