#CEPALCO
#Twetams



    
    
def Info():
    Customer = input('Enter name: ')
    Address = input('Enter address: ')
    ContactNo = input('Enter contact number: ')
    AccountNo = input('Enter account number: ')

    print('\n')
    print('STATEMENT OF ACCOUNT')
    print('\n')
    print('ITEMS                        VATABLE                RATE                  AMOUNT')
    print('GENERATION CHARGE             94.19%                6.8230                2,237.94')
    print('POWER ACT REDUCTION           94.19%               -0,0216               -7.08')
    print('TRANSMISSION CHARGE           86.49%                0.4080                133.82')
    print('SYSTEM LOSS CHARGE            88.17%                0.5393                176.89')
    print('\n')
    print('GEN AND TRANS REVENUE SUBTOTAL:                                           2,541.57')

    print('\n')
    print('DISTRIBUTION REVENUE')
    print('\n')
    print('DISTRIBUTION CHARGE           100.00%                1.4273                468.15')
    print('SUPLLY CHARGE                 100.00%               -0,0216                126.41')
    print('FIX METERING CHARGE           100.00%                                      5.00')
    print('METERING SYSTEM CHARGE        100.00%                0.5393                180.30')
    print('CERA                          100.00%                                            ')
    print('PROMPT PAYMENT DISC/SUR       100.00%                                      -2.50')
    print('\n')
    print('DISTRIBUTION REVENUE SUBTOTAL:                                             777.36')


    print('\n')
    print('SUBSIDES')
    print('\n')
    print('LIFELINE RATE CHG/DISCNT      100.00%                0.0925                 30.34')
    print('SENIOR CITIZEN CHG/DISCNT     100.00%                0.0001                 0.03')
    print('\n')
    print('SUBSIDESSUBTOTAL:                                                           777.36')


    print('\n')
    print('GOVERNMENT TAXES')
    print('\n')
    print('LOCAL FRANCHISE TAX           100.00%                0.7500%                25.12')
    print('ENERGY TAX                                                                       ')
    print('VALUE ADDED TAX(VAT) 12%    P 384.71                                             ')
    print('GENERATION                                                                 252.15')
    print('TRANSMISSION                                                               13.89')
    print('SYSTEM LOSS                                                                18.72')
    print('DISTRIBUTION                                                               96.31')
    print('OTHERS                                                                     3.64')
    
   
    
    print('\n')
    print('GOVERNMENT TAXES SUBTOTAL:                                                 409.83')


    print('\n')
    print('UNIVERSAL CHARGES')
    print('\n')
    print('A)MISSIONARY ELEC NPC-SPUG                            0.1544                50.64')
    print('B)ENVIRONMENTAL CHRG                                  0.0025                0.82')
    print('C)NPC STRANDED DEBTS                                  0.0265                8.69')
    print('D)NPC STRANDED CONTRACT                                                         ')
    print('E)DU STRANDED CONTRACT                                                          ')
    print('F)MISSIONARY ELEC RED                                 0.0017                0.56')
    print('\n')
    print('UNIVERSAL CHARGES SUBTOTAL:                                                 60.71')



    print('FIT-ALL (RENEWABLE            0.00%                   0.2563                84.07')
    print('\n')
    print('                                              TOTAL AMOUNT (VAT INC):      3,903.91')
    print('                                              February 2019 BILL:          3,903.91')
    print('                                              TOTAL AMOUNT DUE:            3,903.91')


    print('VATABLE SALES                3,205.00         TOTAL SALES (VAT INC)        3,903.91')
    print('VAT EXEMPT SALES             313.40           LESS:VAT                     384.71')
    print('ZERO RATED SALES                              AMOUNT NET OF VAT            3,519.20')
    print('VAT AMOUNT                   384.71           LESS: SC/PWD DISCOUNT                ')
    print('                                              AMOUNT DUE                   3,519.20')
    print('                                              ADD:VAT                      384.71')
    print('                                              TOTAL AMOUNT DUE             3,903.91')

    print('\n')
    print('\t\tALWAYS DEMAND AN OFFICIAL RECEIPT,')
    print('\tTHIS IS NOT VALID FOR CLAIM OF INPUT TAX')


    print('NOTES:')
    print('1) PAY ONLY AT CEPALCO OFFICE, ACCREDITED BANKS, SM/SAVEMORE STORES, OR ACCREDITED STORES WITH ECPAY LOGO.')
    print('2) ANY COMPLAINTS NOT SETTLED BY THE DISTRIBUTION UTILITY MAY BE PREFERRED TO ERC THRU TEL#6875577 OR ERC.GOV.PH')
    print('\n')
    print('\t\tPAYMENT REFERENCE NUMBER: 000115461064361190313')

    print('\t\tCEPALCO PAYMENT SLIP')
    print('CONTACT NO:',ContactNo,'                          DUE DATE: 03/13/2019')
    print('CUSTOMER NAME:',Customer)
    print('TOTAL AMOUNT: 3,903.91                         VAT:      384.71')
    print('\t\t\tPAYMENT REFERENCE NUMBER: 000115461064361190313')    
    
    


    

def exit1():
    print('Thank you for using CEPALCO, Have a great day!!')
    




while True:
    print('\n')
    print('\t\t\t***CEPALCO***')
    print('\n')
    print('\t\t[1] - Customer Information')
    print('\t\t[2] - Exit')

    choice = input('What would you like to do?: ')

    if choice == '1':
        Info()
    elif choice == '2':
        exit1()
    else:
        print('Invalid Input, Please try again.')
