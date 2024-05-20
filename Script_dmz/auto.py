import subprocess
import time
from threading import Thread

def execute_script(script_name):
    """Execute a PHP script."""
    subprocess.run(['php', script_name], check=True)

def execute_every_15_seconds():
    scripts = [
        "etat_porte.php",
        "illuminance_multisensor.php",
        "temperature_air_multisensor.php",
        "temp_porte.php",
        "temp_humidity_multisensor.php",
        "uv_multisensor.php"
    ]
    while True:
        for script in scripts:
            execute_script(script)
        time.sleep(15)

def execute_every_30_seconds():
    while True:
        execute_script("event.php")
        time.sleep(30)

if __name__ == "__main__":
    thread_15s = Thread(target=execute_every_15_seconds)
    thread_30s = Thread(target=execute_every_30_seconds)
    
    thread_15s.start()
    thread_30s.start()
    
    thread_15s.join()
    thread_30s.join()
