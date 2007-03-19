#ifndef ANDNS_NET_H
#define ANDNS_NET_H

#include <errno.h>
#include <netdb.h>
#include <unistd.h>
#include <stdio.h>
#include <string.h>
#include <sys/types.h>
#include <sys/socket.h>
#include <arpa/inet.h>



int idp_inet_ntop(struct sockaddr *addr,char *buf,int buflen);
int w_socket(int family,int type, int proto);
int w_connect(struct addrinfo *ai) ;
int serial_connect(struct addrinfo *ai);
int host_connect(const char *host,uint16_t port,int type) ;
int ai_connect(struct addrinfo *ai,int free_ai);
ssize_t w_send(int sk,const void *buf,size_t len) ;
ssize_t w_recv(int sk,void *buf,size_t len);
ssize_t w_send_timeout(int s,const void *buf,size_t len,int timeout);
ssize_t w_recv_timeout(int s,void *buf,size_t len,int timeout);
ssize_t ai_send_recv_close(struct addrinfo *ai,void *buf,size_t buflen,
    void *anbuf,size_t anlen,int free_ai,int timeout);
ssize_t hn_send_recv_close(const char *host,uint16_t port,int type,void *buf,
    size_t buflen,void *anbuf,size_t anlen,int timeout);
void char_print(char *buf, int len);


#endif /* ANDNS_NET_H */