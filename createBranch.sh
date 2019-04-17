#!/bin/bash


git pull

#gets most recent QA branch
CURRBRANCH=git branch-a | grep remotes/origin/QA* | sort -rn | head -n 1 | cut -d/ -f3


#creates a new branch
git checkout -b QA0.01
git push origin QA0.01

