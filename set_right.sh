#!/bin/bash

if [ -f .generated ]; then
      for line in $(cat .generated | sed 's/\/\*$//'); do
         if [ -e $(pwd)$line ]; then
            echo "change permission for $line"
            chmod -R 777 $(pwd)$line
         fi
      done
fi
if [ -f .perms ]; then
      for line in $(cat .perms); do
         if [ -e $(pwd)$line ]; then
            echo "change permission for $line"
            chmod a+w $(pwd)$line
         fi
      done
fi
if [ -f .protected ]; then
      for line in $(cat .protected); do
         if [ -e $(pwd)$line ]; then
            echo "protect $line"
            chmod 600 $(pwd)$line
         fi
      done
fi
if [ -f .writable ]; then
      for line in $(cat .writable); do
         if [ -e $(pwd)$line ]; then
            echo "change writable $line"
            chmod -R 777 $(pwd)$line
         fi
      done
fi
