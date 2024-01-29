#!/bin/bash
cd "$( dirname "${BASH_SOURCE[0]}" )"
if [ -f .generated ]; then
      for line in $(cat .generated | sed 's/\/\*$//'); do
         if [ -e $(pwd)$line ]; then
            echo "change permission 777 for $(pwd)$line"
            chmod -R 777 $(pwd)$line
         fi
      done
fi
if [ -f .perms ]; then
      for line in $(cat .perms); do
         if [ -e $(pwd)$line ]; then
            echo "change permission writable for $(pwd)$line"
            chmod a+w $(pwd)$line
         fi
      done
fi
if [ -f .protected ]; then
      for line in $(cat .protected); do
         if [ -e $(pwd)$line ]; then
            echo "protect 600 $(pwd)$line"
            chmod 600 $(pwd)$line
         fi
      done
fi
cd -
