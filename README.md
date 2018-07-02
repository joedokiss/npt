## About this program:
> it is intended to find out whether there is an available path for the signal to transfer between "Device From" and "Device To" with expected latency, if there is, the available path and corresponding latency will be output

## How to use the program:
### Step 1:
open the CLI, move to the directory having "index.php" file (the directory is "npt" in this case) and ensure the .csv file is stored in the same directory
### Step 2:
input the command as "php index.php csv-file-name.csv", (e.g php index.php data.csv)
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
Sample Input / Output (based on sample CSV data):
Input: A F 1000 Output: Path not found
Input: A F 1200 Output: A => B => D => E => F => 1120
Input: A D 100 Output: A => C => D => 50
Input: E A 400 Output: E => D => B => A => 120
Input: E A 80 Output: E => D => C => A => 60
