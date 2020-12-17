import time, os, random

def bot(direction):
    if random.randint(1,5) == 3:
        if direction == 'right' or direction == 'left':
            if random.randint(1,2) == 1:
                direction = 'up'
            else:
                direction = 'down'
        elif direction == 'up' or direction == 'down':
            if random.randint(1,2) == 1:
                direction = 'right'
            else:
                direction = 'left'
    return direction

def main():
    board_size = 25
    board_x = board_size
    board_y = board_size
    speed = 1
    snake = {'head':[0,0],'food':[random.randint(0,board_size-1),random.randint(0,board_size-1)],'head_direction':'right','tail':'left','blocks':[]}

    while True:

        # Clear Board
        os.system("clear")
        board = [[' ' for x in range(board_x)] for y in range(board_y)]

        #Eat food
        if snake['head'] == snake['food']:
            snake['food'] = [random.randint(0,board_size-1),random.randint(0,board_size-1)]
            snake['blocks'].append([0,0])
        
        for block in range(len(snake['blocks'])-1, 0, -1):
            snake['blocks'][block] = snake['blocks'][block-1]

        for block in snake['blocks']:
            board[block[0]][block[1]] = 'o'
            
        board[snake['head'][0]][snake['head'][1]] = '@'
        board[snake['food'][0]][snake['food'][1]] = '*'

        if len(snake['blocks']) > 0:
            snake['blocks'][0] = snake['head']

        #Move head
        if snake['head_direction'] == 'right':
            if snake['head'][1] < board_size -1:
                snake['head'][1] += 1
            else:
                snake['head'][1] = 0
        elif snake['head_direction'] == 'left':
            if snake['head'][1] > 0:
                snake['head'][1] -= 1
            else:
                snake['head'][1] = board_size -1
        elif snake['head_direction'] == 'down':
            if snake['head'][0] < board_size -1:
                snake['head'][0] += 1
            else:
                snake['head'][0] = 0
        elif snake['head_direction'] == 'up':
            if snake['head'][0] > 0:
                snake['head'][0] -= 1
            else:
                snake['head'][0] = board_size -1
        snake['head_direction'] = bot(snake['head_direction'])
        

        # Move snake parts and check what direction the head faces

        # Display Board
        print(snake['blocks'])
        print("_"*((board_size*2)+2))
        for i in board:
            temp = '|'
            for e in i:
                temp += ' ' + str(e)
            print(temp + "|")
        print("\""*((board_size*2)+2))

        # Speed interval
        time.sleep(speed)
    
if __name__ == "__main__":
    main()