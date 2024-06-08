1. Create virtual env (Once)
```PowerShell
python -m venv .venv
```
2. Activate virtual env
```PowerShell
Set-ExecutionPolicy Unrestricted -Scope Process
.\.venv\Scripts\Activate.ps1
```
3. Install packages
```
python -m pip install -r requirements.txt

python -m pip install pandas

python -m pip install -q google-generativeai

```