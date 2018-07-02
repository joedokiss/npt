## About this program:
> it is intended to find out whether there is an available path between "Device From" and "Device To" with expected latency, if there is, the available path and corresponding latency will be output

## How to use the program:
### Step 1:
open the CLI, move to the directory having "index.php" file (the directory is "npt" in this case) and ensure the .csv file is stored in the same directory
### Step 2:
input the command as "php index.php csv-file-name.csv"
```
note: the program won't continue until the command is input as right format as above
```
### Step 3:
after the CLI validation, you will be asked to "input", the format should be [Device From] [Device To] [Time] (e.g A F 1000 followed by ENTER key)
```
note: 
(1) each segment shall be divided by a whitespace
(2) the latency time shall be positive
```
