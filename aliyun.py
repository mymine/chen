from aligo import Aligo

from aligo import Auth
#调用实例
upload = {
        - name: 上传到阿里云盘
        run: |
          sudo apt-get update
          python3 -m venv $PWD/venv
          pip3 install -U aligo
          pip install -U aligo
          python3 aliyun.py
  }
ali = Aligo(name='refresh_token' , refresh_token='c5fd8e0644d64516983579fefad10e0d')

ali.upload_folder('/home/runner/Magisk/done', parent_file_id='6446693a452a7031169f475ea109ca159c1c01bc')   
