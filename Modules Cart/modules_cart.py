

modules  = []
prices = []
total = 0

while True:
    module = input("Enter a module to enrol for or press q to quit")
    if module.lower() == 'q':
        break
    else:
        price = float(input(f"Enter price of the {module}: R"))
        modules.append(module)
        prices.append(price)

        print("------Your List of Desired Modules-------")

        for module in modules:
            print(module)

        for price in prices:
            total += price

print(f"Your total is: R(total)")

