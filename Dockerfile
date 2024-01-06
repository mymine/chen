FROM alpine
RUN apk update
RUN apk upgrade

RUN wget -c https://github.com/alist-org/alist/releases/latest/download/alist-linux-musl-mipsle.tar.gz -O /home/alist_linux_mipsle.tar.gz
#COPY ./home/alist_linux_mipsle.tar.gz /home/alist_linux_mipsle.tar.gz
RUN tar -zxvf /home/alist_linux_mipsle.tar.gz -C /home

WORKDIR /home/alist_linux_mipsle


ENTRYPOINT [ "./alist server" ]
CMD [ "-p", "5244" ]

# * build *
# ./build-by-xgo.sh linux_amd64 min
# docker build . -t "admpub/nging:latest"
# * test * 
# docker run --rm -it -p "7770:9999" admpub/nging:latest

