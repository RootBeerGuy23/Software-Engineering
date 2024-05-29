package main

import (
    "crypto/tls"
    "fmt"
    "net"
    "time"
)

func main() {
    // Website to connect to
    hostname := "www.google.com:1122"

    // Establish a TCP connection
    conn, err := net.DialTimeout("tcp", hostname, 10*time.Second)
    if err != nil {
        fmt.Printf("Failed to connect: %v\n", err)
        return
    }
    defer conn.Close()

    // Initiate a TLS handshake
    tlsConn := tls.Client(conn, &tls.Config{
        InsecureSkipVerify: true,
    })
    err = tlsConn.Handshake()
    if err != nil {
        fmt.Printf("TLS handshake failed: %v\n", err)
        return
    }
    defer tlsConn.Close()

    // Get the connection state
    state := tlsConn.ConnectionState()

    // Print the TLS version
    fmt.Printf("TLS Version: %v\n", tlsVersion(state.Version))

    // Print the CipherSuite
    fmt.Printf("CipherSuite: %v\n", tls.CipherSuiteName(state.CipherSuite))

    // Print the Issuer Organization
    if len(state.PeerCertificates) > 0 {
        cert := state.PeerCertificates[0]
        fmt.Printf("Issuer Organization: %v\n", cert.Issuer.Organization)
    } else {
        fmt.Println("No peer certificates found")
    }
}

func tlsVersion(version uint16) string {
    switch version {
    case tls.VersionTLS13:
        return "TLS 1.3"
    case tls.VersionTLS12:
        return "TLS 1.2"
    case tls.VersionTLS11:
        return "TLS 1.1"
    case tls.VersionTLS10:
        return "TLS 1.0"
    default:
        return "Unknown"
    }
}
