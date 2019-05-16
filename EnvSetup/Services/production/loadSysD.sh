#!/bin/bash
sudo cp rabbitbrokerstart.service /etc/systemd/system/rabbitbrokerstart.service

sudo systemctl daemon-reload
sudo enable rabbitbrokerstart.service
sudo start rabbitbrokerstart.service
