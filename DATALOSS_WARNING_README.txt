WARNING: THIS IS A TEMPORARY DISK.

Any data stored on this drive is SUBJECT TO LOSS and THERE IS NO WAY TO
RECOVER IT.

Please do not use this disk for storing any personal or application data.

For additional details to please refer to the MSDN documentation at:
http://msdn.microsoft.com/en-us/library/windowsazure/jj672979.aspx

To remove this warning run:
    sudo chattr -i /mnt/DATALOSS_WARNING_README.txt
    sudo rm /mnt/DATALOSS_WARNING_README.txt

This warning is written each boot; to disable it:
    echo "manual" | sudo tee /etc/init/ephemeral-disk-warning.override
    sudo systemctl disable ephemeral-disk-warning.service

