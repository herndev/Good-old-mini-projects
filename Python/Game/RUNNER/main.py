import pygame, sys, random
from pygame.locals import*
 
pygame.init()

#SCREEN
sw = 500
sh = 400
frame_per_sec = 10
fpsClock = pygame.time.Clock()

screen = pygame.display.set_mode((sw,sh))
pygame.display.set_caption("Runner")
#SCREEN END

#VARS
ready_jump = True
jump_count = 0

#PLAYER
player = pygame.image.load('img/green1.gif')
playerh = 50
playerw = 50
playerx = 10
playery = sh - (playerh + 25) + 2
moves = 1
mover = True


#COLORS
RED = (255, 0, 0)
BLACK = (0, 0, 0)
AQUA = (0, 255, 255)
WHITE = (255, 255, 255)

#BLOCK
temp = 0
spacer = 0
blocks = []
area = random.randint(sw, sw+100)
tempo = int(area)
blocks.append([0, sh-25, tempo, 25])
temp = blocks[0][2]



#TREES
tree = []
treeh = 100
treew = 50
treex = 0
treey = sh - (playerh + 25) + 2
treng = 0


for i in range(3):
    tree.append([random.randint(50, sw-50), sh-125, treew, treeh,  'img/tree'+ str(random.randint(1,4)) +'.gif'])


for b in range(4):
    spacer = random.randint(50, 100)
    blocks.append([temp + spacer, sh-25, random.randint(100, 400), 25, spacer])
    temp = blocks[-1][2] + blocks[-1][0]



#---------------------------------------------------------
while True:
    
    screen.fill(BLACK)
    
    for event in pygame.event.get():
	
	if event.type == KEYDOWN:
	    if event.key == K_UP and ready_jump:
		playery -= 50
		mover = False
		jump_count += 1
		player = pygame.image.load('img/green10.gif')
		if jump_count >= 2:
		    ready_jump = False
	    elif event.key == K_RIGHT:
		playerx += 10
	    elif event.key == K_LEFT:
		playerx -= 10
		
	
	if event.type == QUIT:
	    pygame.quit()
	    sys.exit()
    
    
    #GRAVITY--------------------------------------------------------------------
    if playery <= sh - (playerh + 25) + 2:
	playery += 2
	player = pygame.image.load('img/green11.gif')
	
    elif playery >= sh - (playerh + 25) + 6:
	playery += 2
    else:
	ready_jump = True
	mover = True
	jump_count = 0
    
    
    #BLOCKING-----------------------------------------------------------------------
    for b in range(4):
	spacer = random.randint(50, 100)
	area = random.randint(100, 400)
	tempo = int(area)
	blocks.append([temp + spacer, sh-25, tempo, 25, spacer])
	treng = random.randint(0, 3)
	if treng == 1:
	    tree.append([random.randint(temp + spacer, (temp + spacer)+area-50), sh-125, treew, treeh, 'img/tree'+ str(random.randint(1,4)) +'.gif'])

	temp = blocks[-1][2] + blocks[-1][0]
    
	
    for j,i in enumerate(blocks):
	i[0] -= 5
	if playery == sh - (playerh + 25)+4 and (i[0]+i[2] <= playerx or i[0]+i[2] <= playerx+1) and ((i[0]+i[2]+i[-1])-10 >= playerx or (i[0]+i[2]+i[-1])-10 >= playerx+1):
	    playery += 2

	pygame.draw.rect(screen, AQUA, (i[0],i[1],i[2],i[3]))
	
    #TREE
    for i in tree:
	i[0] -= 5
	screen.blit(pygame.image.load(i[-1]), (i[0],i[1]))
    
    if moves != 10 and mover:
	name = "img/green" + str(moves+1)
	name += ".gif"
	player = pygame.image.load(name)
	moves+=1
    elif moves == 10 and mover:
	moves=2
	player = pygame.image.load('img/green2.gif')
	
    
    #pygame.draw.rect(screen, RED, (playerx, playery, playerw, playerh))
    screen.blit(player,(playerx,playery))
    fpsClock.tick(frame_per_sec)
    pygame.display.update()
