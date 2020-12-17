# Getting the BMI height in meter
def getBMI(height, weight):

# BMI formula
BMI = weight / (height * height)

return BMI


threshold = "Overweight" # Declare threshold
height = 1.46 #Sample height
weight = 49 #Sample weight

# Manual input height and weight
# height = int(input('Height: '))
# weight = int(input('weight: '))

# Initializing BMI
BMI = getBMI(height, weight)

# Manual input BMI
# BMI = int(input('BMI: '))

if(BMI < 25):
if(BMI < 18.5):
threshold = "Underweight"
elif(BMI >= 18.5 and BMI <= 24.9):
threshold = "Normal"

print('BMI: %d.2' % BMI)
print('Threshold: %s' % threshold)